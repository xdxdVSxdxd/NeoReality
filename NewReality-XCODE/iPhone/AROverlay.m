//
//  AROverlay.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "AROverlay.h"
#import <math.h>


@implementation AROverlay

@synthesize elements, curLocation, curHeading, arViews;

- (id)initWithFrame:(CGRect)frame {
    
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code.
		arViews = [[NSMutableDictionary alloc] initWithCapacity:100];
		accelerometer = [UIAccelerometer sharedAccelerometer];
		accelerometer.updateInterval = .1;
		accelerometer.delegate = self;
		
		accx = 0;
		accy = 0;
		accz = 0;
		
		isUpdatingDrawing = NO;
    }
    return self;
}


- (void)accelerometer:(UIAccelerometer *)accelerometer didAccelerate:(UIAcceleration *)acceleration {
	
	
	accx = acceleration.x;
	accy = acceleration.y;
	accz = acceleration.z;
	
	//NSLog(@"(x,y,z)=%f,%f,%f",currAcceleration.x,currAcceleration.y,currAcceleration.z );
}

/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect {
    // Drawing code.
	[self updateDrawing];
}
*/

- (BOOL) shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation{
	return (interfaceOrientation==UIInterfaceOrientationPortrait);
}




-(void) loadUpdatedElements: (NSArray *) newElements
{

	if (!elements) {
		elements = [[NSMutableDictionary alloc] initWithCapacity:20];
	}
	
	//NSArray *values = [newElements allValues];
	
	for (int i=0; i<[newElements count]; i++) {
		
		NSDictionary *e = (NSDictionary *) [newElements objectAtIndex:i];
		
		NSString *idc = (NSString *) [e objectForKey:@"id"];
		
		if(idc!=nil){
			NSObject *v = [elements objectForKey:idc];
		
			if(v!=nil){
		
				[elements removeObjectForKey:idc];
		
			}
		
			[elements setObject:e forKey:idc];
			
			if(!arViews){
				arViews = [[NSMutableDictionary alloc] initWithCapacity:100];
			}
			
			OverlayView *temp = (OverlayView *) [arViews objectForKey:idc];
			if(temp==nil){
				temp = [[OverlayView alloc] initWithTitle: [e objectForKey:@"title"]  imageId:[e objectForKey:@"id"] imageURL:[e objectForKey:@"content"] latitude:[[e objectForKey:@"lat"] floatValue] longitude:[[e objectForKey:@"lon"] floatValue] identifier: (NSString *) idc ];
			
				[self addSubview:temp];
			
			} else {
				[temp setTitolo:[e objectForKey:@"title"]];
				[temp setImageUrl:[e objectForKey:@"content"]];
				[temp setLat:[[e objectForKey:@"lat"] floatValue]];
				[temp setLon:[[e objectForKey:@"lon"] floatValue]];
				[temp setIdentifier:(NSString *) idc];
				[temp updateView];
			}
			
			[arViews setObject:temp forKey:idc];
			
		
		}
		
	}
	
}


-(void) updateDrawing
{
	
	
	if(!isUpdatingDrawing){
		
		isUpdatingDrawing = YES;

		//NSLog(@"currhead:%@\ncurrLoc:%@\n\n",self.curHeading,self.curLocation);
		NSArray *keys = [arViews allKeys];
		NSObject *k;
		OverlayView *v;
		CLLocation *tmpLoc;
		float lat1,lat2,lon1,lon2;
	
		//CGRect scrsiz = [[UIScreen mainScreen] applicationFrame];
	
		lat1 = self.curLocation.coordinate.latitude*180/M_PI;
		lon1 = self.curLocation.coordinate.longitude*180/M_PI;
	
		for(int i=0; i<[keys count]; i++){
	
			k = [keys objectAtIndex:i];
			v = [arViews objectForKey:k];
	
			lat2 = v.lat*180/M_PI;
			lon2 = v.lon*180/M_PI;
		
			tmpLoc = [[CLLocation alloc] initWithLatitude:v.lat longitude:v.lon];
		
		
			//double latDelta = (lat2 - lat1);
			double lonDelta = (lon2 - lon1);
			double yy = sin(lonDelta) * cos(lat2);
			double xx = cos(lat1) * sin(lat2) - sin(lat1) * cos(lat2)* cos(lonDelta);
			double angle = atan2(yy, xx); //not finished here yet
			double headingDeg = self.curHeading.trueHeading;
			double angleDeg = angle * 180/M_PI;
			double heading = headingDeg*M_PI/180;
			angle = fmod(angleDeg + 360, 360) * M_PI/180; //normalize to 0 to 360 (instead of -180 to 180), then convert back to radians
			angleDeg = angle * 180/M_PI;
		
		
			//CORREGGERE!
			float distance = [self.curLocation distanceFromLocation:tmpLoc];
			//NSLog(@"distanza:%f",distance);
		
			
			double deltaangledeg = (angle-heading)*180/M_PI;
			//NSLog(@"da=%f",deltaangledeg);
			
			
			
			
			float ax = sin(angle-heading) * distance;
			float az = cos(angle-heading) * distance; //typically, z faces into the screen, but in our 2D map, it is a y-coordinate, as if you are looking from the bottom down on the world, like Google Maps
			//float ay = (accz + 1) * 0.8f*scrsiz.size.height / 2; 
			//NSLog(@"ay=%f",ay);
			float screenX = (ax * 256) / az;
			float screenY = 20;//(ay * 256) / az;
			
			//if([v.titolo isEqualToString:@"verso stazione trastevere"]){
			//	NSLog(@"[%@]->deltaA=%f",v.titolo, deltaangledeg);
			//}
			
			
			if(accy>0 || deltaangledeg>45 || deltaangledeg<0 || distance>1000 ){
				[v setHidden:YES];
			} else {
				[v setHidden:NO];
				if(distance<100){
					[v setAlpha:1.0f];
				} else {
					[v setAlpha:(1.0f-(distance-100.0f)/900.0f)];
				}
				
				
				/*
				if(distance>300.0f){
					[v setTransform:CGAffineTransformIdentity];
				} else {
					float s = 3.0f - 2.0f*distance/300.0f;
					[v setTransform:CGAffineTransformScale(CGAffineTransformIdentity, s, s)];
				}
				*/

			}

		
			v.frame = CGRectMake(screenX, screenY, 70,110);
		
	
		}
		
		isUpdatingDrawing = NO;
	}
	
}






- (void)dealloc {
	[curHeading release];
	[curLocation release];
	[elements release];
	[arViews release];
	[super dealloc];
}


@end
