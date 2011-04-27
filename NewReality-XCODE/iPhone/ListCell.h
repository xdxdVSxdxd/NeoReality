//
//  ListCell.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/18/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>


@interface ListCell : UITableViewCell {

	NSObject *identificatore;
	UILabel *titolo;
	UIImageView *iv;
	UIImage *im;
	
}
@property (nonatomic,retain) NSObject *identificatore;
@property (nonatomic,retain) UILabel *titolo;
@property (nonatomic,retain) UIImageView *iv;
@property (nonatomic,retain) UIImage *im;
- (void) updateTitolo:(NSString *)aTitle imageUrl:(NSString *) anImageUrl identifier:(NSObject *) anIdentifier;
@end
