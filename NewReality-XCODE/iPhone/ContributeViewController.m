    //
//  ContributeViewController.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "ContributeViewController.h"


@implementation ContributeViewController

@synthesize curLocation, curHeading;

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



        

// Implement loadView to create a view hierarchy programmatically, without using a nib.
- (void)loadView {
	
	
	

	if (cv1==nil) {
		cv1 = [[ContributeVC1 alloc] init];
		cv1.title = @"Enter Contribution";
		[cv1.view setUserInteractionEnabled:YES];
		[cv1.nextButton addTarget:self action:@selector(gotoStep2:withEvent:) forControlEvents:UIControlEventTouchDown];
	}

	if (cv2==nil) {
		cv2 = [[ContributeVC2 alloc] init];
		cv2.title = @"Choose image";
		[cv2.view setUserInteractionEnabled:YES];
	}

	if (cv3==nil) {
		cv3 = [[ContributeVC3 alloc] init];
		cv3.title = @"Set Price";
		[cv3.view setUserInteractionEnabled:YES];
	}

	if (cv4==nil) {
		cv4 = [[ContributeVC4 alloc] init];
		cv4.title = @"Upload";
		[cv4.view setUserInteractionEnabled:YES];
	}
	
	//ncontroller = [[UINavigationController alloc] initWithRootViewController:cv1];
	
	//NSArray *vvccs = [NSArray arrayWithObjects:cv1,cv2,cv3,cv4,nil];
	//[ncontroller pushViewController:cv1 animated:YES];
	//[ncontroller setViewControllers:vvccs];
	
	//[ncontroller pushViewController:cv1 animated:YES];
	
	//self.view = ncontroller.view;
	self.view = cv1.view;
}



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




- (void) gotoStep2: (UIControl *) c withEvent:ev
{
	[cv1.titleTextField resignFirstResponder];
	NSLog(@"clicked next");
}


- (void)dealloc {
	[curHeading release];
	[curLocation release];
	[cv1 release];
	[cv2 release];
	[cv3 release];
	[cv4 release];
    [super dealloc];
}


@end
