Thème MRC de Maskinongé
Description : Site officiel de Tourisme Maskinongé | Développement et intégration : Joël Dion | Graphisme : Cognitif
Version: 1.5.8

1.0.1
- Changed style of sub-menu
- Changed order of blog post on home page

1.0.2
- Fix: related events appear when unpublished

1.0.3 
- Added URL "mode" parameter for faster access to attraction map

1.0.4
- Fix: attraction coordinates (lat, lng) are not generated in site admin

1.0.5
- Changed layout of main menu

1.0.6
- Fix: text overlapping background shape on single attraction page 

1.0.7
- Events with multiple dates are now sorted according to their start date instead of their end date

1.0.9
- Changed background image for teaser ("dormir")

1.1.5
- Added temporary modal

1.2.1
- Added default template (page.php)
- Changed style of bold text

1.2.2
- Minor style change to "<sup>" elements

1.2.3
- Fix: "tm-script.js" using current timestamp instead of Theme version on public site 

1.2.4
- Fix: empty event category listing (event-categories.php)

1.2.5 
- Fix: Attraction contact address overlapping mobile screen
- "tm-contact" address is now displayed on 2 lines

1.3.0 
- Fix: wrong attractions show up when switching categories using AJAX and clicking on "Load more" button
- Fix: Cities without events in the location filter
- Added sortable Start/End Date and Location columns to events (admin)
- Added event list to location meta box (admin)
- Added "Event Count" column in location list (admin)
- Removed event count from location meta data

1.4.0 
- Fix: social icons don't appear in footer + minor style changes
- Footer content is now editable except the last 2 blog posts which appear automaticaly
- Multiple strings added to localization (tourismemaskinonge-fr_CA.po)

1.4.5
- Added cron job to unpublish past events
- Fix: Event 'Information' label showing when all fields are empty
- Fix: footer social icons not showing
- Minor changes to footer icons style
- Footer content is now editable in admin except for the automated latests posts (blog)
- Added strings to localization file (tourismemaskinonge-fr_CA.po)
- Added contact page selector to Contact Info admin settings
- Nav icons links are now taken from Contact Info admin settings
- Added redirection to draft posts + localization of 404 page
- Minor bug fixes

1.4.6 
- Added 1 day before unpublishing past events

1.4.7
- Fix: Event location "Locate" link not using Google Maps URL (admin)

1.4.8 
- Fix: Card titles show stripped "&nbsp;" 

1.4.9
- Fix: Translation of 'Search' not showing on search results page

1.4.10
- Fix: Single event not showing main category

1.5.0
- Added localization of "tm-script-admin.js"
- Localized some strings
- Fix: listing home pages not showing the page's slider image
- Fix: event location Google Maps link showing city twice
- Home page teasers are now fully editable in admin

1.5.1 
- Changed default slide

1.5.2 
- Minor changes to modal

1.5.3
- Fix: today's events considered expired and not showing
- Added '<sup>er</sup>' to card first day of month (french)

1.5.4
- Fix: cron job for unpublishing expired events not working properly

1.5.5
- Fix: Missing language markup
- Fix: Duplicate H1 tags on front page

1.5.6
- Fix: Background shape overlapping blog top text

1.5.7
- Fix: removed 'date_default_timezone_set()' function calls

1.5.8
- Added H3 to event location title 
- Footer titles are now wrapped in H4 instead of H3