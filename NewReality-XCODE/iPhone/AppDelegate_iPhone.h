//
//  AppDelegate_iPhone.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "VisionViewController.h"
#import "ListTableViewController.h"
#import "AROverlay.h"
#import <CoreLocation/CoreLocation.h>
#import "ASIHTTPRequest.h"
#import "JSON.h"
#import "InfoScreen.h"

@interface AppDelegate_iPhone : NSObject < CLLocationManagerDelegate,UIApplicationDelegate,UITabBarControllerDelegate, UINavigationControllerDelegate, UIImagePickerControllerDelegate> {
    UIWindow *window;
	VisionViewController *visionVC;
	ListTableViewController *listVC; 
	UITabBarController *tabs;
	AROverlay *arOverlay;
	CLLocationManager *locationManager;
	CLLocation *bestEffortAtLocation;
	CLLocation *lastUpdateDoneAtLocation;
	CLHeading *lastHeading;
	SBJsonParser *jsonParser;
	BOOL isUpdatingContent;
	UIActivityIndicatorView *loadingView;
	InfoScreen *infoScreen;
	
}

@property (nonatomic, retain) IBOutlet UIWindow *window;
@property (nonatomic, retain) VisionViewController *visionVC;
@property (nonatomic, retain) ListTableViewController *listVC;
@property (nonatomic, retain) UITabBarController *tabs;
@property (nonatomic, retain) AROverlay *arOverlay;
@property (nonatomic, retain) CLLocationManager *locationManager;
@property (nonatomic, retain) CLLocation *bestEffortAtLocation;
@property (nonatomic, retain) CLHeading *lastHeading;
@property (nonatomic, retain) SBJsonParser *jsonParser;
@property (nonatomic, retain) UIActivityIndicatorView *loadingView;
@property (nonatomic, retain) InfoScreen *infoScreen;
-(void) updateContent;

@end

