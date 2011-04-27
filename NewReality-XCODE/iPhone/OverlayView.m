//
//  OverlayView.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/14/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "OverlayView.h"


@implementation OverlayView

@synthesize titolo, lat, lon, idImage, imageUrl, titleLabel, img, identifier;

- (id)initWithFrame:(CGRect)frame {
    
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code.
    }
    return self;
}

-(id) initWithTitle: (NSString *) aTitle imageId: (NSString *) anImageId imageURL: (NSString *) anImageUrl latitude: (float) aLatitude longitude: (float) aLongitude identifier: (NSString *) anIdentifier
{

	self = [super init];
    if (self) {
		
		[self setFrame:CGRectMake(0, 0, 70, 460)];
		
		UIImageView *bkovview = [[UIImageView alloc] initWithFrame:CGRectMake(0, 0, 70, 460)];
		UIImage *imbkov = [UIImage imageNamed:@"ovbk.png"];
		[bkovview setImage:imbkov];
		
		[self addSubview:bkovview];
		[bkovview release];
		[imbkov release];
		
		[self setUserInteractionEnabled:YES];
		
		[self setIdentifier:[anIdentifier copy]];
		
        // Initialization code.
		[self setTitolo:[aTitle copy]];
		[self setIdImage:[anImageId copy]];
		self.lat = aLatitude;
		self.lon = aLongitude;
		[self setImageUrl:[anImageUrl copy]];
		
		titleLabel = [[UILabel alloc] initWithFrame:CGRectMake(0, 0, 70, 24) ];
		[titleLabel setText:titolo];
		[titleLabel setTextColor:[UIColor whiteColor ]];
		[titleLabel setTextAlignment:UITextAlignmentLeft];
		[titleLabel setFont:[UIFont systemFontOfSize:10.0f]];
		[titleLabel setLineBreakMode:UILineBreakModeWordWrap];
		[titleLabel setNumberOfLines:2];
		[titleLabel setBackgroundColor:[UIColor blackColor]];
		
		[self addSubview:titleLabel];
		
		
		
		NSData *imageData = [[NSData alloc] initWithContentsOfURL:[NSURL URLWithString:self.imageUrl]];
		UIImage *imga = [[UIImage alloc] initWithData:imageData]; 
		
		img = [[UIImageView alloc] initWithFrame:CGRectMake(0, 24, 70, 80)];
		
		[img setImage:imga];
		
		[self addSubview:img];
		
	}
    return self;

}


-(void) updateView
{
	[titleLabel setText:titolo];
	
	NSData *imageData = [[NSData alloc] initWithContentsOfURL:[NSURL URLWithString:self.imageUrl]];
	
	UIImage *imga = [[UIImage alloc] initWithData:imageData]; 
	
	[img setImage:imga];
	
}



/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect {
    // Drawing code.
}
*/

- (void)dealloc {
	[img release];
	[titolo release];
	[idImage release];
	[imageUrl release];
	[titleLabel release];
	[identifier release];
    [super dealloc];
}


@end
