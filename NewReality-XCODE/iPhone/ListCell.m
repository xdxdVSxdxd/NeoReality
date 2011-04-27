//
//  ListCell.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "ListCell.h"


@implementation ListCell

@synthesize identificatore, titolo, iv,im;

- (id)initWithStyle:(UITableViewCellStyle)style reuseIdentifier:(NSString *)reuseIdentifier {
    
    self = [super initWithStyle:style reuseIdentifier:reuseIdentifier];
    if (self) {
        // Initialization code.
		
		
		
		[self setFrame:CGRectMake(0, 0, 320, 75)];
		
		
		UIImageView *bgimgv = [[UIImageView alloc] initWithFrame:self.frame];  
		UIImage *ima = [UIImage imageNamed:@"cellbg.png"];
		[bgimgv setImage:ima];
		self.backgroundView = bgimgv;
		[bgimgv release];
		
		
		titolo = [[UILabel alloc] initWithFrame:CGRectMake(75, 5, 245, 60) ];
		[titolo  setText:@""];
		[titolo  setTextColor:[UIColor blackColor ]];
		[titolo  setTextAlignment:UITextAlignmentLeft];
		[titolo  setFont:[UIFont systemFontOfSize:14.0f]];
		[titolo  setLineBreakMode:UILineBreakModeWordWrap];
		[titolo  setNumberOfLines:4];
		//[titolo  setBackgroundColor:[UIColor colorWithRed:0.6f green:0.6f blue:1.0f alpha:1.0f ]];
		[titolo setBackgroundColor:[UIColor clearColor]];
		[self addSubview:titolo ];
		
		iv = [[UIImageView alloc] initWithFrame:CGRectMake(0, 0, 70, 70)];
		[self addSubview:iv];

    }
    return self;
}

- (void) updateTitolo:(NSString *)aTitle imageUrl:(NSString *) anImageUrl identifier:(NSObject *) anIdentifier
{

	self.identificatore = anIdentifier;
	
	[titolo setText:aTitle];
	
	NSData *imageData = [[NSData alloc] initWithContentsOfURL:[NSURL URLWithString:anImageUrl]];
	
	if (im!=nil) {
		[im release];
	}
	
	im = [[UIImage alloc] initWithData:imageData]; 
	
	[iv setImage:im];
	

}


- (void)setSelected:(BOOL)selected animated:(BOOL)animated {
    
    [super setSelected:selected animated:animated];
    
    // Configure the view for the selected state.
}


- (void)dealloc {
	[identificatore release];
	[titolo release];
	[iv release];
	[im release];
    [super dealloc];
}


@end
