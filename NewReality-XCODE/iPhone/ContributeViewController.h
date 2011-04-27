//
//  ContributeViewController.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>
#import <CoreLocation/CoreLocation.h>
#import "ContributeVC1.h"
#import "ContributeVC2.h"
#import "ContributeVC3.h"
#import "ContributeVC4.h"

@interface ContributeViewController : UIViewController {

	CLLocation *curLocation;
	CLHeading *curHeading;
	ContributeVC1 *cv1;
	ContributeVC2 *cv2;
	ContributeVC3 *cv3;
	ContributeVC4 *cv4;
	UINavigationController *ncontroller;
	
}
@property (nonatomic,retain) CLLocation *curLocation;
@property (nonatomic,retain) CLHeading *curHeading;
@end
