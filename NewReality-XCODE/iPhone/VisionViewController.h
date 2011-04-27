//
//  VisionViewController.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "AROverlay.h"
#import "DetailViewController.h"

@interface VisionViewController :  UIImagePickerController {

	AROverlay *arOverlay;
	DetailViewController *dvc;
	
	
}
@property (nonatomic,retain) AROverlay *arOverlay;
@end
