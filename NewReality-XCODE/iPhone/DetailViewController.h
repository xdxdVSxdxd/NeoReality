//
//  DetailViewController.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "CloseButtonView.h"
#import "ApriButtonView.h"

@interface DetailViewController : UIViewController <UIWebViewDelegate>{

	UIWebView *webView;
	CloseButtonView *closeButton;
	ApriButtonView *apriButton;
	UIActivityIndicatorView *loadingView;
	NSString *identifier;
	
}
@property (nonatomic,retain) UIWebView *webView;
@property (nonatomic,retain) NSString *identifier;
-(void) loadUrl: (NSString *) anUrl;
@end
