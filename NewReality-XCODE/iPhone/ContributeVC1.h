//
//  ContributeVC1.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/22/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>


@interface ContributeVC1 : UIViewController <UITextViewDelegate> {
	UIView *mainView;
	UILabel *titleLabel;
	UILabel *helpLabel;
	UITextView *titleTextField;
	UIButton *nextButton;
}

@property (nonatomic,retain) UIView *mainView;
@property (nonatomic,retain) UILabel *titleLabel;
@property (nonatomic,retain) UILabel *helpLabel;
@property (nonatomic,retain) UITextView *titleTextField;
@property (nonatomic,retain) UIButton *nextButton;

@end
