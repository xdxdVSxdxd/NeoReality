    //
//  VisionViewController.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "VisionViewController.h"
#import "AppDelegate_iPhone.h"


@implementation VisionViewController

@synthesize arOverlay;

// The designated initializer.  Override if you create the controller programmatically and want to perform customization that is not appropriate for viewDidLoad.
/*
- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil {
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization.
    }
    return self;
}
*/
/*
// Implement loadView to create a view hierarchy programmatically, without using a nib.
- (void)loadView {

	
	
}
*/

/*
// Implement viewDidLoad to do additional setup after loading the view, typically from a nib.
- (void)viewDidLoad {
    [super viewDidLoad];
}
*/

/*
// Override to allow orientations other than the default portrait orientation.
- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation {
    // Return YES for supported orientations.
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}
*/

- (void)didReceiveMemoryWarning {
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Release any cached data, images, etc. that aren't in use.
}

- (void)viewDidUnload {
    [super viewDidUnload];
    // Release any retained subviews of the main view.
    // e.g. self.myOutlet = nil;
}



- (BOOL) shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation{
	return (interfaceOrientation==UIInterfaceOrientationPortrait);
}


- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event
{
	NSEnumerator *oe = [touches objectEnumerator];
	BOOL foundO = NO;
	
	UITouch *object;
	
	
	
	while ((object = (UITouch *) [oe nextObject]) && !foundO) {
		
		
			if ([object.view isKindOfClass:[CloseButtonView class]]) {
				foundO = YES;
			
				[dvc.view removeFromSuperview];
			
			}
		
			else if ([object.view isKindOfClass:[OverlayView class]]) {
				foundO = YES;
				
				OverlayView *tempO = (OverlayView *) object.view;
				NSLog(@"http://www.art-basel.org/neoreality/wordpress/getPost.php?id=%@",[tempO identifier]);
				
				
				if(dvc==nil){
					dvc = [[DetailViewController alloc] init];
				}
				
				//[self presentModalViewController:dvc animated:YES];
				
				[dvc setIdentifier: [tempO identifier]];
				
				[self.view addSubview:dvc.view];
				
				[dvc.view setUserInteractionEnabled:YES];
				
				[dvc loadUrl: [NSString stringWithFormat:@"http://www.art-basel.org/neoreality/showPost.php?id=%@",[tempO identifier] ] ];
				
			}
	}
	
}



- (void)dealloc {
	[dvc release];
 	[arOverlay release];
    [super dealloc];
}


@end
