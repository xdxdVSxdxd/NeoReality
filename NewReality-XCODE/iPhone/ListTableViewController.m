//
//  ListTableViewController.m
//  NeoReality
//
//  Created by salvatore iaconesi on 4/13/11.
//  Copyright 2011 AOS. All rights reserved.
//

#import "ListTableViewController.h"


@implementation ListTableViewController

@synthesize elements;

#pragma mark -
#pragma mark Initialization

- (id)initWithStyle:(UITableViewStyle)style {
    // Override initWithStyle: if you create the controller programmatically and want to perform customization that is not appropriate for viewDidLoad.
    self = [super initWithStyle:style];
    if (self) {
        // Custom initialization.
		[self.tableView setBackgroundColor:[UIColor blackColor]];
    }
    return self;
}


#pragma mark -
#pragma mark View lifecycle


- (void)viewDidLoad {
    [super viewDidLoad];

    // Uncomment the following line to display an Edit button in the navigation bar for this view controller.
    // self.navigationItem.rightBarButtonItem = self.editButtonItem;

	[self.tableView setSeparatorColor:[UIColor clearColor]];

}

/*
- (void)viewWillAppear:(BOOL)animated {
    [super viewWillAppear:animated];
}
*/
/*
- (void)viewDidAppear:(BOOL)animated {
    [super viewDidAppear:animated];
}
*/
/*
- (void)viewWillDisappear:(BOOL)animated {
    [super viewWillDisappear:animated];
}
*/
/*
- (void)viewDidDisappear:(BOOL)animated {
    [super viewDidDisappear:animated];
}
*/
/*
// Override to allow orientations other than the default portrait orientation.
- (BOOL)shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation {
    // Return YES for supported orientations.
    return (interfaceOrientation == UIInterfaceOrientationPortrait);
}
*/


#pragma mark -
#pragma mark Table view data source


- (UIView *)tableView:(UITableView *)tableView viewForHeaderInSection:(NSInteger)section
{

	UIImageView *bgimgv = [[UIImageView alloc] initWithFrame:CGRectMake(0, 0, 320.0f, 40.0f)];  
	UIImage *ima = [UIImage imageNamed:@"tableHead.png"];
	[bgimgv setImage:ima];
	
	return bgimgv;
}


- (CGFloat)tableView:(UITableView *)tableView heightForHeaderInSection:(NSInteger)section
{
	return 40.0f;
}

- (NSInteger)numberOfSectionsInTableView:(UITableView *)tableView {
    // Return the number of sections.
    return 1;
}


- (NSInteger)tableView:(UITableView *)tableView numberOfRowsInSection:(NSInteger)section {
    // Return the number of rows in the section.
	
	NSInteger r = 0;
	if (elements!=nil) {
		r = [[elements allKeys] count];
	}
	NSLog(@"returning LC element count: %d",r);
    return r;
}


// Customize the appearance of table view cells.
- (UITableViewCell *)tableView:(UITableView *)tableView cellForRowAtIndexPath:(NSIndexPath *)indexPath {
    
    static NSString *CellIdentifier = @"ListCell";
    
    ListCell *cell = (ListCell *) [tableView dequeueReusableCellWithIdentifier:CellIdentifier];
    if (cell == nil) {
        cell = [[[ListCell alloc] initWithStyle:UITableViewCellStyleDefault reuseIdentifier:CellIdentifier] autorelease];
    }
    
    // Configure the cell...
	NSObject *anIdentifier = [[elements allKeys] objectAtIndex:indexPath.row];
	NSDictionary *e = (NSDictionary *) [elements objectForKey:anIdentifier];
    
	[cell updateTitolo:[e objectForKey:@"title"] imageUrl:[e objectForKey:@"content"] identifier:anIdentifier];
	
	NSLog(@"returning cell for identifier:%@",anIdentifier);
	
    return cell;
}


- (CGFloat)tableView:(UITableView *)tableView heightForRowAtIndexPath:(NSIndexPath *)indexPath
{
    return 75.0f;
}


/*
// Override to support conditional editing of the table view.
- (BOOL)tableView:(UITableView *)tableView canEditRowAtIndexPath:(NSIndexPath *)indexPath {
    // Return NO if you do not want the specified item to be editable.
    return YES;
}
*/


/*
// Override to support editing the table view.
- (void)tableView:(UITableView *)tableView commitEditingStyle:(UITableViewCellEditingStyle)editingStyle forRowAtIndexPath:(NSIndexPath *)indexPath {
    
    if (editingStyle == UITableViewCellEditingStyleDelete) {
        // Delete the row from the data source.
        [tableView deleteRowsAtIndexPaths:[NSArray arrayWithObject:indexPath] withRowAnimation:UITableViewRowAnimationFade];
    }   
    else if (editingStyle == UITableViewCellEditingStyleInsert) {
        // Create a new instance of the appropriate class, insert it into the array, and add a new row to the table view.
    }   
}
*/


/*
// Override to support rearranging the table view.
- (void)tableView:(UITableView *)tableView moveRowAtIndexPath:(NSIndexPath *)fromIndexPath toIndexPath:(NSIndexPath *)toIndexPath {
}
*/


/*
// Override to support conditional rearranging of the table view.
- (BOOL)tableView:(UITableView *)tableView canMoveRowAtIndexPath:(NSIndexPath *)indexPath {
    // Return NO if you do not want the item to be re-orderable.
    return YES;
}
*/


#pragma mark -
#pragma mark Table view delegate

- (void)tableView:(UITableView *)tableView didSelectRowAtIndexPath:(NSIndexPath *)indexPath {
    // Navigation logic may go here. Create and push another view controller.
    /*
    <#DetailViewController#> *detailViewController = [[<#DetailViewController#> alloc] initWithNibName:@"<#Nib name#>" bundle:nil];
     // ...
     // Pass the selected object to the new view controller.
    [self.navigationController pushViewController:detailViewController animated:YES];
    [detailViewController release];
    */
	
	NSLog(@"selected row:%d",indexPath.row);
	if(detailViewController==nil){
		detailViewController = [[DetailViewController alloc] init];
	}
	
	NSString *anIdentifier = (NSString *) [[elements allKeys] objectAtIndex:indexPath.row];
	
	[detailViewController setIdentifier: anIdentifier];
	[self.view addSubview:detailViewController.view];
	
	[detailViewController.view setUserInteractionEnabled:YES];
	
	[detailViewController loadUrl: [NSString stringWithFormat:@"http://www.art-basel.org/neoreality/showPost.php?id=%@",anIdentifier ] ];
	
}


#pragma mark -
#pragma mark Memory management

- (void)didReceiveMemoryWarning {
    // Releases the view if it doesn't have a superview.
    [super didReceiveMemoryWarning];
    
    // Relinquish ownership any cached data, images, etc. that aren't in use.
}

- (void)viewDidUnload {
    // Relinquish ownership of anything that can be recreated in viewDidLoad or on demand.
    // For example: self.myOutlet = nil;
}

- (BOOL) shouldAutorotateToInterfaceOrientation:(UIInterfaceOrientation)interfaceOrientation{
	return NO;
}

-(void) loadUpdatedElements: (NSArray *) newElements
{
	
	if (!elements) {
		elements = [[NSMutableDictionary alloc] initWithCapacity:20];
	}
	
	//NSArray *values = [newElements allValues];
	
	for (int i=0; i<[newElements count]; i++) {
		
		NSDictionary *e = (NSDictionary *) [newElements objectAtIndex:i];
		
		NSString *idc = (NSString *) [e objectForKey:@"id"];
		
		if(idc!=nil){
			NSObject *v = [elements objectForKey:idc];
			
			if(v!=nil){
				
				[elements removeObjectForKey:idc];
				
			}
			
			[elements setObject:e forKey:idc];
			
			
		}
		
	}
	
}


- (void)dealloc {
	[elements release];
	[detailViewController release];
    [super dealloc];
}


@end

