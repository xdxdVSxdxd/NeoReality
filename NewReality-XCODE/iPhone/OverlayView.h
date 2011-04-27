//
//  OverlayView.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/14/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>


@interface OverlayView : UIView {
	
	NSString *titolo;
	float lat;
	float lon;
	NSString *idImage;
	NSString *imageUrl;
	NSString *identifier;
	UILabel *titleLabel;
	UIImageView *img;

}

@property (nonatomic, retain) NSString *titolo;
@property (nonatomic) float lat;
@property (nonatomic) float lon;
@property (nonatomic, retain) NSString *idImage;
@property (nonatomic, retain) NSString *imageUrl;
@property (nonatomic, retain) UILabel *titleLabel;
@property (nonatomic, retain) UIImageView *img;
@property (nonatomic,retain) NSString *identifier;

-(id) initWithTitle: (NSString *) aTitle imageId: (NSString *) anImageId imageURL: (NSString *) anImageUrl latitude: (float) aLatitude longitude: (float) aLongitude identifier: (NSString *) anIdentifier;
-(void) updateView;
@end
