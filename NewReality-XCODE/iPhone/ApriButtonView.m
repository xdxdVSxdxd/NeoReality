//
//  ApriButtonView.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "ApriButtonView.h"


@implementation ApriButtonView


- (id)initWithFrame:(CGRect)frame {
    
    self = [super initWithFrame:frame];
    if (self) {
        // Initialization code.
		apriIcon = [[UIImageView alloc] initWithImage:[UIImage imageNamed:@"apro.png"]]; 
		[self addSubview:apriIcon];
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
	[apriIcon release];
    [super dealloc];
}


@end
