//
//  ListTableViewController.h
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "ListCell.h"
#import "DetailViewController.h"


@interface ListTableViewController : UITableViewController <UITableViewDelegate,UITableViewDataSource> {
	
	NSMutableDictionary *elements;
	DetailViewController *detailViewController;

}
@property (nonatomic,retain) NSMutableDictionary *elements;
-(void) loadUpdatedElements: (NSArray *) newElements;

@end
