//
//  AppDelegate_iPhone.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "AppDelegate_iPhone.h"

@implementation AppDelegate_iPhone

@synthesize window, visionVC, listVC, tabs, arOverlay, locationManager, bestEffortAtLocation, lastHeading, jsonParser, loadingView, infoScreen;


#pragma mark -
#pragma mark Application lifecycle

- (BOOL)application:(UIApplication *)application didFinishLaunchingWithOptions:(NSDictionary *)launchOptions {    
    
    // Override point for customization after application launch.
	
	isUpdatingContent = NO;
	
	arOverlay = [[AROverlay alloc] initWithFrame:[[UIScreen mainScreen] applicationFrame]];
	
	visionVC = [[VisionViewController alloc] init];
	//[visionVC setTitle:@"View"];
	[visionVC setSourceType:UIImagePickerControllerSourceTypeCamera];
	[visionVC setShowsCameraControls:NO];
	[visionVC setNavigationBarHidden:NO];
	[visionVC setToolbarHidden:YES];
	[visionVC setWantsFullScreenLayout:NO];
	[visionVC setCameraOverlayView:arOverlay];
	
	visionVC.tabBarItem = [[UITabBarItem alloc] initWithTitle:@"" image:[UIImage imageNamed:@"eye.png"] tag:1];
	
	visionVC.delegate = self;
	
    listVC = [[ListTableViewController alloc] initWithStyle:UITableViewStylePlain ];
	listVC.title = @"List";
	listVC.tabBarItem = [[UITabBarItem alloc] initWithTitle:@"" image:[UIImage imageNamed:@"list.png"] tag:2];
	[listVC.tableView setDelegate:listVC];
	[listVC.tableView setDataSource:listVC];
	
	
	infoScreen = [[InfoScreen alloc] init];
	infoScreen.title = @"Info";
	infoScreen.tabBarItem = [[UITabBarItem alloc] initWithTitle:@"" image:[UIImage imageNamed:@"info.png"] tag:3];
	
	
	
	tabs = [[UITabBarController alloc] init];
	[tabs setViewControllers:[[NSArray alloc] initWithObjects: visionVC,listVC, infoScreen, nil] animated:YES];
	tabs.delegate = self;
	
	[self.window addSubview:tabs.view];	
    [self.window makeKeyAndVisible];
	
	locationManager = [[CLLocationManager alloc] init];
	locationManager.delegate = self;
	locationManager.desiredAccuracy = kCLLocationAccuracyBest;
	locationManager.distanceFilter = kCLDistanceFilterNone;
	locationManager.headingFilter = kCLHeadingFilterNone;
	[locationManager startUpdatingLocation];
	[locationManager startUpdatingHeading];
    
    return YES;
}


- (BOOL) shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation{
	return (interfaceOrientation==UIInterfaceOrientationPortrait);
}


- (void)applicationWillResignActive:(UIApplication *)application {
    /*
     Sent when the application is about to move from active to inactive state. This can occur for certain types of temporary interruptions (such as an incoming phone call or SMS message) or when the user quits the application and it begins the transition to the background state.
     Use this method to pause ongoing tasks, disable timers, and throttle down OpenGL ES frame rates. Games should use this method to pause the game.
     */
}


- (void)applicationDidEnterBackground:(UIApplication *)application {
    /*
     Use this method to release shared resources, save user data, invalidate timers, and store enough application state information to restore your application to its current state in case it is terminated later. 
     If your application supports background execution, called instead of applicationWillTerminate: when the user quits.
     */
}


- (void)applicationWillEnterForeground:(UIApplication *)application {
    /*
     Called as part of  transition from the background to the inactive state: here you can undo many of the changes made on entering the background.
     */
}


- (void)applicationDidBecomeActive:(UIApplication *)application {
    /*
     Restart any tasks that were paused (or not yet started) while the application was inactive. If the application was previously in the background, optionally refresh the user interface.
     */
}


- (void)applicationWillTerminate:(UIApplication *)application {
    /*
     Called when the application is about to terminate.
     See also applicationDidEnterBackground:.
     */
}







- (void)locationManager:(CLLocationManager *)manager didUpdateToLocation:(CLLocation *)newLocation fromLocation:(CLLocation *)oldLocation
{

	self.bestEffortAtLocation = [newLocation copy];
	
	[arOverlay setCurLocation:self.bestEffortAtLocation];
	[arOverlay updateDrawing];
	
	
	float distance = 0;
	
	if(lastUpdateDoneAtLocation){
		distance = [self.bestEffortAtLocation distanceFromLocation:lastUpdateDoneAtLocation];
	}
	
	if (!lastUpdateDoneAtLocation || distance>200.0f ) {
		//invoca aggiornamento punti
		
		if (!isUpdatingContent) {
			isUpdatingContent = YES;
			[self updateContent];
		}
		
	}
	
	

}


- (void)locationManager:(CLLocationManager *)manager didFailWithError:(NSError *)error
{
	NSLog(@"Error getting location");
}

- (void)locationManager:(CLLocationManager *)manager didUpdateHeading:(CLHeading *)newHeading
{
	self.lastHeading = [newHeading copy];
	
	[arOverlay setCurHeading:self.lastHeading];
	[arOverlay updateDrawing];
	
	
}

- (BOOL)locationManagerShouldDisplayHeadingCalibration:(CLLocationManager *)manager
{
	return YES;
}









-(void) updateContent
{
	if(loadingView!=nil){
		[loadingView release];
		loadingView = nil;
	}
	
	CGRect scrsize = [[UIScreen mainScreen] applicationFrame];
	
	loadingView = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhiteLarge];
	[loadingView setCenter:CGPointMake(scrsize.size.width/2.0, scrsize.size.height/2.0)]; // I do this because I'm in landscape mode
	[visionVC.view  addSubview:loadingView]; // spinner is not visible until started
	[loadingView startAnimating];
	
	//NSLog(@"Will be requesting:\nhttp://www.art-basel.org/neoreality/wordpress/getARPoints.php?lat=%f&lon=%f", bestEffortAtLocation.coordinate.latitude, bestEffortAtLocation.coordinate.longitude);

	NSURL *url = [NSURL URLWithString: [NSString stringWithFormat: @"http://www.art-basel.org/neoreality/wordpress/getARPoints.php?lat=%f&lon=%f", bestEffortAtLocation.coordinate.latitude, bestEffortAtLocation.coordinate.longitude ]];
	ASIHTTPRequest *request = [ASIHTTPRequest requestWithURL:url];
	[request setDelegate:self];
	[request startAsynchronous];
	
}





- (void)requestFinished:(ASIHTTPRequest *)request
{
	// Use when fetching text data
	NSString *responseString = [[request responseString] copy];
	
	//NSLog(@"Received Response:\n\n%@", responseString);
	
	
	NSArray *rd = (NSArray *) [responseString JSONValue];
	
	
	[arOverlay loadUpdatedElements:rd];
	[listVC loadUpdatedElements:rd];
	
	lastUpdateDoneAtLocation = [bestEffortAtLocation copy];
	
	//[rd release];
	
	isUpdatingContent = NO;
	[loadingView stopAnimating];
	[loadingView removeFromSuperview]; 
	
}






- (void)requestFailed:(ASIHTTPRequest *)request
{
	isUpdatingContent = NO;

	[loadingView stopAnimating];
	[loadingView removeFromSuperview]; 

	NSError *error = [request error];
	NSLog(@"Received Error:\n\n%@", error);

}


#pragma mark -
#pragma mark Memory management

- (void)applicationDidReceiveMemoryWarning:(UIApplication *)application {
    /*
     Free up as much memory as possible by purging cached data objects that can be recreated (or reloaded from disk) later.
     */
}


- (void)dealloc {
	[infoScreen release];
	[loadingView release];
	[locationManager release];
	[lastHeading release];
	[bestEffortAtLocation release];
	[lastUpdateDoneAtLocation release];
	[tabs release];
	[listVC release];
	[visionVC release];
	[arOverlay release];
	[jsonParser release];
    [window release];
    [super dealloc];
}


@end
