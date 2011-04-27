//
//  CloseButtonView.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "CloseButtonView.h"


@implementation CloseButtonView


- (id)initWithFrame:(CGRect)frame {
    
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code.
		closeIcon = [[UIImageView alloc] initWithImage:[UIImage imageNamed:@"closo.png"]]; 
		[self addSubview:closeIcon];
	
	}
    return self;
}

/*
// Only override drawRect: if you perform custom drawing.
// An empty implementation adversely affects performance during animation.
- (void)drawRect:(CGRect)rect {
    // Drawing code.
}
*/

- (void)dealloc {
	[closeIcon release];
    [super dealloc];
}


@end
