//
//  AROverlay.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import "OverlayView.h"

@interface AROverlay : UIView <UIAccelerometerDelegate>{
	
	NSMutableDictionary *elements;
	NSMutableDictionary *arViews;
	CLLocation *curLocation;
	CLHeading *curHeading;
	UIAccelerometer *accelerometer;
	double accx,accy,accz;
	BOOL isUpdatingDrawing;
}
@property (nonatomic,retain) NSMutableDictionary *elements;
@property (nonatomic,retain) NSMutableDictionary *arViews;
@property (nonatomic,retain) CLLocation *curLocation;
@property (nonatomic,retain) CLHeading *curHeading;

-(void) loadUpdatedElements: (NSArray *) newElements;

-(void) updateDrawing;

@end
