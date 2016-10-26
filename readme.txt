a# onepiece
Wordpress Theme in Development
/**
readme.txt

by CP Mueller - 2016 The Hague 
Webdesign Den Haag | Oddsized
**/

Theme to be applied by Wordpress Code Monkeys :-)
  Not available in the Wordpress Theme directory
  Keep track of updates here - https://github.com/Oddsized/onepiece
  Use the github-updater plugin by Andy Fragen - https://github.com/afragen

HTML and basic css is available, custom theme style can be applied in a custom stylesheet wich can be selected inside the theme customizer. ! Current all Branches testing php fread to get .css files this might result in errors or blank screen on some shared-hosting platforms.

Most common page markups can be achieved without any code hassle:

Theme options are build in the theme customizer, post metaboxes and page-templates.
The basic post/page view has extended meta options by default, including controlling 2 default sidebars and a headerimage or content slider. 

The isotope gallery theme adds it own gallery settings to a page including category and tag filter menu's.
Made with Isotope code by David DeSandro - https://github.com/desandro. 

The theme default slider options are set default in the theme customizer and specified for pages in the page slider-metabox. Made with the AnythingSlider code by Rob Garrison aka CSS-tricks - https://github.com/CSS-Tricks/AnythingSlider/wiki, 

Menu's can have positioned images.
Made with the Menu Image code by Alex Davyskiba aka Zviryatko - http://html-and-cms.com/plugins/menu-image/

Views are enhanced with responsive methodes
Mobile detection made with code by Andy Moore http://detectmobilebrowsers.mobi 


Highlights:

> flexible positioning of sidebars, menu's and widgets
> lot's of default options in customizer (ie. show author/date)
> featured images can replace header image
> isotope masonry gallery with filtermenu

In development:

- customizer style & layout stylesheet selection (add your own stylesheet)
- gallery (isotope) item click action types & views
- childpage content mixed in parent page (subpage menu/slidedown boxes / menu fade page)
- slider animations



Features:


Gallery Page Metabox:
- Select a category to display (parent category for category menu)
- Set the max amount of items in a row
- Display titlebar (show page title/text) 
- Display Filter Navigation (none/categories/cats&tags)


Default Metabox Pages:
- set featured image as (replace) header image 
- display the page-sidebar (none/top/bottom of mainsidebar or no mainsidebar at all)
- display sidebars (main and/or second)
- display special widgets area (same area on/off on pages)
- display before and/or after content widget area's
- [in development..] Childpages on parent page display


Default Metabox Posts:
- Custom Link (an  alternative link for the posts)
- Link text (string to link) 
- Link function (separate button/replacing post permalink current/new window)


Product Metabox Posts:
- Product Price  
- Price Discount(%)  
- Product Size  (xs,s,m,l,xl)
- Dimensions (package/product x,y,z) 
- Dimension measurement in mm, cm, m, km, mile
- [implement todo..] Weight (package/product total)  
- [implement todo..] Weight measurement in mg, gram, kilogram, ton
- Labeled ( No/New/Special/Featured/Coming soon/All time favourite)


Customizer Options:

Identity:
    Logo image 
        image medium
    	max-width
        image small
    
    Title, Tagline & Icon image
        Site Title
        Site Description/Tagline
        Site Icon image
    
    Featured image
        image
		content max width
		
	Style & Layout
	    select style (css files)
	   
Content:
    Static front page (default)
    Pages
        date/author display

    Posts
        Use highlight first posts
        Display date/author
        Featured image header
        
    Category
        [todo] Exclude categories
        Display category list Title & Description 

   
Elements:

    Background image    
    Top menu bar
        Display none/position  
    
    [todo] Login tabbar    
        [todo] Display none/position
      
    Header image
		Image
		Headerimage width (content/full)
    Main menu bar
        Display none/position
    Main Sidebar
        Display none/position
        Width       
    Second Sidebar
        Display none/position
        Position inside/outside
        Width
    Footerbar
        Bottom menu display none/position

Menu's:
    Top
    Main
    Side
    Bottom
    
Widgets:
    Top
    Header
    Sidebar
    Sidebar2
    Special Widgets
    Before (content)
    After (content)
    Subcontent
    Bottom

Responsive
	Small
		screen max width (switch to medium)
		outermargin default width (%)
		content max width
	Medium
		screen max width (switch to large)
		outermargin default width (%)
		content max width
	Large
