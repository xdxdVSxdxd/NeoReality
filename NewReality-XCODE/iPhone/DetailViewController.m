    //
//  DetailViewController.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "DetailViewController.h"


@implementation DetailViewController

@synthesize webView,identifier;

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
	
	UIImageView *bkview = [[[UIImageView alloc] initWithImage:[UIImage imageNamed:@"dvbk.png"]] autorelease]; 
	[bkview setBackgroundColor:[UIColor clearColor]];
	self.view = bkview;
	[bkview setUserInteractionEnabled:NO];
	
	
	webView = [[UIWebView alloc] init];
	[webView setBackgroundColor:[UIColor clearColor]];
	[webView setFrame: CGRectMake(40, 55, 240, 330)];
	[webView setScalesPageToFit:NO];
	[webView setDelegate:self];
	
	[webView setUserInteractionEnabled:NO];
	
	[self.view addSubview:webView];
	
	closeButton = [[CloseButtonView alloc] initWithFrame:CGRectMake(10, 10,40, 40)];
	[self.view addSubview:closeButton];
	[closeButton setUserInteractionEnabled:YES];
	
	
	apriButton = [[ApriButtonView alloc] initWithFrame:CGRectMake(60, 10,40, 40)];
	[self.view addSubview:apriButton];
	[apriButton setUserInteractionEnabled:YES];
	
}



- (void)touchesBegan:(NSSet *)touches withEvent:(UIEvent *)event
{
	
	
	
	
	NSEnumerator *oe = [touches objectEnumerator];
	BOOL foundO = NO;
	
	UITouch *object;
	
	
	
	while ((object = (UITouch *) [oe nextObject]) && !foundO) {
	
		NSLog(@"Touched detailed view[%@]",[object.view class]);
		
		if ([object.view isKindOfClass:[CloseButtonView class]]) {
			foundO = YES;
			
			[self.view removeFromSuperview];
			
		} else if ([object.view isKindOfClass:[ApriButtonView class]]) {
			foundO = YES;
			
			NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://www.art-basel.org/neoreality/wordpress/?p=%@",self.identifier]];
			
			if (![[UIApplication sharedApplication] openURL:url])
				
				NSLog(@"%@%@",@"Failed to open url:",[url description]);
			
			
		}
	}
	
}




-(void) loadUrl: (NSString *) anUrl
{
	if(webView!=nil){
		
		
		
		if(loadingView!=nil){
			[loadingView release];
			loadingView = nil;
		}
		
		CGRect scrsize = [self.view bounds];
		
		loadingView = [[UIActivityIndicatorView alloc] initWithActivityIndicatorStyle:UIActivityIndicatorViewStyleWhiteLarge];
		[loadingView setCenter:CGPointMake(scrsize.size.width/2.0, scrsize.size.height/2.0)]; // I do this because I'm in landscape mode
		[self.view  addSubview:loadingView]; // spinner is not visible until started
		[loadingView startAnimating];
		
		
		
		
		[webView loadRequest:[NSURLRequest requestWithURL:[NSURL URLWithString:anUrl] ] ];
	}
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



- (void)webView:(UIWebView *)webView didFailLoadWithError:(NSError *)error
{

	if (loadingView!=nil) {
		[loadingView stopAnimating];
		[loadingView removeFromSuperview];
	}
}


- (BOOL)webView:(UIWebView *)webView shouldStartLoadWithRequest:(NSURLRequest *)request navigationType:(UIWebViewNavigationType)navigationType
{
	return YES;
}


-(void)webViewDidFinishLoad:(UIWebView *)aWebView
{
	NSLog(@"Loaded page:%d",[aWebView bounds].size.height);
	
	if (loadingView!=nil) {
		[loadingView stopAnimating];
		[loadingView removeFromSuperview];
	}
	

}

- (void)webViewDidStartLoad:(UIWebView *)webView
{}



- (void)dealloc {
	[webView release];
	[closeButton release];
	[apriButton release];
	[loadingView release];
	[identifier release];
	[super dealloc];
}


@end
