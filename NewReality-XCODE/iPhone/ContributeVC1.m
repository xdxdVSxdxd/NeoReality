    //
//  ContributeVC1.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/22/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "ContributeVC1.h"


@implementation ContributeVC1

@synthesize mainView, titleLabel, helpLabel, titleTextField, nextButton;


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

	

	
	mainView = [[UIView alloc] initWithFrame:CGRectMake(0, 0, 320, 480)  ];//[[UIScreen mainScreen] applicationFrame]];
	
	[mainView setBackgroundColor:[UIColor blackColor]];
	
	titleLabel = [[UILabel alloc] initWithFrame:CGRectMake(20, 35, 280, 50)];
	[titleLabel setText:@"CONTRIBUTE TO\nNEOREALITY"];
	[titleLabel setFont:[UIFont systemFontOfSize:20.0f]];
	[titleLabel setTextColor:[UIColor yellowColor]];
	[titleLabel setBackgroundColor:[UIColor blackColor]];
	[titleLabel setTextAlignment:UITextAlignmentLeft];
	[titleLabel setLineBreakMode:UILineBreakModeWordWrap];
	[titleLabel setNumberOfLines:2];
	[titleLabel setUserInteractionEnabled:NO];
	
	[mainView addSubview:titleLabel];
	
	
	helpLabel = [[UILabel alloc] initWithFrame:CGRectMake(20, 90, 280, 50)];
	[helpLabel setText:@"start your contribution to NeoReality\nby entering a title and then\npressing CHOOSE IMAGE"];
	[helpLabel setFont:[UIFont systemFontOfSize:12.0f]];
	[helpLabel setTextColor:[UIColor whiteColor]];
	[helpLabel setBackgroundColor:[UIColor blackColor]];
	[helpLabel setTextAlignment:UITextAlignmentLeft];
	[helpLabel setLineBreakMode:UILineBreakModeWordWrap];
	[helpLabel setNumberOfLines:3];
	[helpLabel setUserInteractionEnabled:NO];
	
	[mainView addSubview:helpLabel];
	
	
	titleTextField = [[UITextField alloc] initWithFrame:CGRectMake(20, 160, 280, 30)];
	[titleTextField setPlaceholder:@"the Title"];
	[titleTextField setFont:[UIFont systemFontOfSize:24]];
	[titleTextField setBackgroundColor:[UIColor whiteColor]];
	
	[titleTextField setDelegate:self];
	
	[mainView addSubview:titleTextField];
	
	nextButton = [UIButton buttonWithType:UIButtonTypeRoundedRect];
	[nextButton setFrame:CGRectMake(20, 200, 130, 25)];
	[nextButton setTitle:@"CHOOSE IMAGE" forState:UIControlStateNormal];
	[mainView addSubview:nextButton];
	
	
	
	
	[self setView:mainView];
	
}


- (BOOL)textViewShouldEndEditing:(UITextView *)textView
{
	[textView resignFirstResponder];
	return YES;
}

- (void)textViewDidEndEditing:(UITextView *)textView
{
	
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


- (void)dealloc {
	[nextButton release];
	[helpLabel release];
	[titleTextField release];
	[titleLabel release];
	[mainView release];
    [super dealloc];
}


@end
