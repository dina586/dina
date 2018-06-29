CintaNotes for Windows 2000 / XP / Vista / 7
Copyright(C) Cinta Software, http://cintanotes.com
==============================================================================

Running
------------------------------------------------------------------------------

Portable version: Start cintanotes.exe from its home folder. Complete usage 
instructions are available in the help file, which can be opened using the 
"Help / Help" menu command. 

Installable version: Run using the created start menu shortcut.


Upgrading
------------------------------------------------------------------------------

Portable version: Extract all files from the folder inside of the downloaded 
archive into your current CintaNotes folder, overwriting old files. 
Your notebook and settings won't be overwritten.

Installable version: run the installer and point it to your current 
CintaNotes folder. 

Upgrading from CintaNotes Beta to CintaNotes 1.X is a bit more difficult 
because CintaNotes 1.3 dropped support for the Beta .dat file format. 
You need to export your notes to an XML file first, and after installation 
of the latest version re-import it using the "File/Import" command.


User Files
------------------------------------------------------------------------------

User files are located in the CintaNotes folder by default.
However, in case CintaNotes folder is located in the "Program Files" or
"Program Files (x86)" folder, then the files are moved to the CintaNotes 
subfolder of the %APPDATA% folder.

cintanotes.db (configurable)    - Notes database
cintanotes.settings         - Program settings
backup\notebook.hourly.db   - Hourly backup of the notes database
backup\notebook.daily.db    - Daily backup of the notes database
backup\notebook.weekly.db   - Weekly backup of the notes database



Reporting Problems
------------------------------------------------------------------------------

If you're encountering problems with CintaNotes please go to 
http://cintanotes.com and make sure that you're running the latest version 
of CintaNotes.

If the problem is with the latest version, please report it on our 
feedback forum: http://cintanotes.userecho.com



Version History
------------------------------------------------------------------------------

Nov 24, 2014  Version 2.8.3
  Enhancements:
  - Focus notes list on minimize (enables starting new search immediately 
    after restoring CN window later)
  - Updated UI translations

  Fixes:
  - Backup: backup options got cleared on restart
  - Crash on pasting into filtered notes list 
  - Editor: note link corruption after manipulating lists


Nov 10, 2014  Version 2.8.2
  Enhancements:
  - Better right-to-left languages support with the new settings 
    "app.mainframe.rtlenabled" and "app.mainframe.userightalignbydefault "
  - Search history: auto add search terms to history after a short timeout 
  - Editor: note link tooltips should stay long enough to read note text 
  - Don't run backup and sync for notebooks located in the backup folder

  Fixes:
  - Editor: paragraph text formatting hotkeys don't change current formatting state
  - Tag sidebar: Untagged count was not updated after moving notes to other section
  - Search history: Back and forward buttons flickered when pressed


Oct 27, 2014  Version 2.8.1
  Enhancements:
  - Search history: Current state always displayed in the history menu

  Fixes:
  - Tag sidebar: wrong tag count display
  - Notes list: Paragraph formatting was not immediately updated in note preview 
    after edit
  - Search history: Unwanted states got inserted into history
  - Search history: Back and forward buttons flickered when pressed
  - Simplenote sync: in some cases tags could get deleted on upload
  - Notebook title appeared in lowercase after closing another notebook
  - Tag suggestion list was unsorted
  - Deleting a section didn't move its notes to the Recycle Bin 

Oct 16, 2014  Version 2.8
  Features:
  - Search history: forward and backward navigation on the search bar
  - Search history menu on right click on back and forward buttons
  - Add option Tags/Autodeleted by default
  
  Enhancements:
  - Tag sidebar: tags font is now configurable with "app.mainframe.tagsidebar.font"
    settings file option
  - Improved notebook loading and switching performance
  - Improved section switching performance
  - Improved notes list scrolling performance
  - Improved tag renaming, splitting and merging performance
  - Improved import performance
  - Don't reset filter to keep just edited note visible by default (will affect
    new installations only)
  - Recycle bin: upon restoring notes, create sections if necessary
  
  Fixes:
  - Editor: fixed outstanding stateful text formatting issues
  - Tag sidebar: scrolling should stop when mouse button is released
  - Editor: "Insert Link" command is disabled when selected text is wrapped
  - Editor: vertical tabs are treated as paragraph separators
  - Editor: inconsistent behavior of some text formatting shortcuts
  - Fix possible crash on import
  - Notebook file name in app title turns to lower case
  - Tab scrolling sometimes can freeze
  - Simplenote sync: fix many causes for crashes and hangs

Sep 15, 2014  Version 2.7.2
  Enhancements:
  - Tag sidebar: tooltips with full tag name when tag name doesn't fit
  - Editor: make editor's icon different from main window icon
  - Notes list: Change of sorting should keep selection
  - Editor: make text formatting shortcuts stateful
  - Editor: Enter in the title should move focus to the note's text
  - Editor: add "Indent/Outdent" context menu options
  - Editor: don't create empty notes even when OK pressed
  - Change shortcuts for moving sections to Ctrl+Shift+Alt+Left/Right

  Fixes:
  - "No internet connection" error on some configurations
  - Possible startup error "SystemMenu::insertItem failed"
  - Editor: pasting into list item error
  - Editor: Undo could skip events
  - Licensing: "License expired" when license.key file is not writable
  - Simplenote sync: notes deleted in other clients weren't moved to trash
  - Simplenote sync: possible inability to successfully finish sync
 

Aug 21, 2014  Version 2.7.1
  Enhancements:
  - New option: "Options/Startup/Notify when Activating Existing Instance"
  - Editor: improved pasting into lists
    New setting "editor.lists.paste.alwaysintoitem" and new command
    "Paste Into List Item"
  - Simplenote sync: improve syncing down of notes w/o #section tag
  - Anti-feature bloat: removed unnecessary options "Editor/Text Formatting" 
   and "Editor/Auto-Indent"
  
  Fixes:
  - Editor: removing bullet list style didn't work correctly for multiline 
    paragraphs
  - Editor: entering CJK symbols with Microsoft IME corrupted links
  - Editor/Replace: "Replace All" button worked as simple "Replace" when 
    activated with Enter key
  - Clipping: whitespace trimming could in some cases corrupt newlines
  - Command line interface: Opening notebook didn't work when path 
    contained quotes, spaces or national symbols  
  - Simplenote sync: in some cases sync could't finish always try to update
    same notes
  - Message boxes could appear on the wrong screen with a dual screen setup
  - Fixed wrong UI labels when "lang" directory is missing

Aug 4, 2014  Version 2.7
  Features:
  - Simple note printing
  - Right and center paragraph alignment support

  Enhancements:
  - Add "Always display full tag names" to notes list options
  - Editor: Add shortcuts for applying formatting to current paragraph
    (Ctrl+Shift+B, Ctrl+Shift+I, etc.)
  - Translatable keyboard shortcuts
  - Added screenshots to help
  - Added "All files" option to File/Open and File/Import
  - Tag sidebar: right click doesn't change tag selection anymore
  - Editor/Search: focus and select all text in the search box on 
    Ctrl+F

  Fixes:
  - Notes list: Strikeout and underlined text problem
  - Crash on pressing Ctrl+F12 in opened note
  - Editor: Ctrl+Bksp in lists eats vertical tab
  - Tag hint window positioning error with multiple screens
  - Editor: lost bullet while copy & pasting of bullet list
  - Editor: pasting text from PuTTy didn't work for some users
  - License dialog: license delete hint is cut in German UI
  - Dialogs positioning error with multiple screens
  - Note properties dialog: wrong statistics for unsaved notes
  - Tag autocomplete not displayed when searching in "Any text field"
  - Editor: BkSp+Undo+BkSp corrupts links
  - Editor: error when clicking a link to a file with CJK characters
    in name
  

Jun 05, 2014  Version 2.6.1
  Enhancements:
  - Make search string always shared between sections
  - Double click to select all sections
  - Middle click to change inbox section
  - Pasted notes now go into their original section if it is currently active
  - Search string like "-tag" now works for negating tags from the search box

  Fixes:
  - Import error on non-lowercase file extension
  - Editor: Crash after selecting all text and trying to "Find previous"
  - Editor: Single lines were copied with bullet markers
  - Editor: Numbered lists were copied to notepad with wrong counting
  - Editor: Ctrl+C in Link field was not always working
  - Editor: Empty line added via Shift+Enter doesn't end bulleted and numbered 
      lists
  - Delete note confirmation message dialog could get extremely wide 
  - Tag list filter setting was reset on notebook switching
  - (Regression) Search: Negated words in search were not working
  - Notes list: Multiple Ctrl+BkSp lead to a crash
  - Fixed possible crash on start when default notebook needs to be upgraded


May 08, 2014   Version 2.6
  Features:
  - Editor: Search and replace inside of note edit dialog
  - Notes list: double click in empty area to add new note

  Enhancements:
  - Export: provide default filename
  - Export: reduce UI clutter, remove unnecessary groupboxes
  - Editor: add "Properties..." to context menu
  - Focused note and note selection for each section are now remembered 
    on program restart
  - Option to hide "All" button on section bar, with it being hidden by default
  - Tag sidebar: tag list filtering settings are now remembered on restart
  - License dialog: Replace "Buy" button with "Renew" when license is present
  - Notes list: Make selected and unselected notes more distinguishable
  - Notes list: Try to keep scroll position and focused note on tag filter change

  Fixes:
  - Simplenote sync: search filter is reset after sync (regression)
  - Editor: don't apply list markers to empty lines
  - Editor: shortened URLs not entirely visible in the Link field
  - Recycle Bin: crash after mouse click when list is empty
  - Editor: "mailto:" links diplayed incorrectly
  - Buttons remain hover-highlighted even after mouse leave
  - Section-related error when clipping with "display in editor" turned on
  - "Replace tags" command changes current tag selection
  - Export: Error while exporting to old XML format
  - Simplenote sync: creation date is killed when synced after FlickNote
  - Alt+Shift+C shouldn't activate menu mnemonics
  - Editor: link formatting becomes corrupted after undoing Shift+Enter
  - Editor: control focus is lost after Alt+Tab


Mar 27, 2014   Version 2.5.2
  Enhancements:
  - Editor: Ctrl+Home/End in any field except Remarks to go to text start and end
  - Make Alt+F+number work regardless of keyboard layout

  Fixes:
   - Notes list: Incorrect rendering of a clipped numbered list
   - Notes list: Jumping numbers in numbered lists
   - Clipping: Numbers could disappear from numbered lists on clipping
   - Options/Hot keys: edit field background was not white
   - Export: Errors during export lead to program crash
   - Export: Exporting tags only to text file lead to program crash
   - Search: Tags with capital letters were not highlighted in note previews
   - Tune settings to help prevent "database disk image is malformed" error

Feb 20, 2014   Version 2.5.1
   Enhancements:
   - Added F2 as a shortcut for "Edit" command.
   - Improved tray icon click behavior.
     Bring CN window to foreground if CN window is obscured by other windows.
   - Editor: edit link immediately on Alt+L.
   
   Fixes:
   - Editor: Alt+NumPad character input not working properly.
   - Editor: exception when undoing bullet list edit.
   - Editor: random character at end of text.
   - Simplenote sync: CN could hang on exit.
    -Simplenote sync: sync could hang.
   - Simplenote sync: CN used to reset SN's Markdown flag.
   - Tag autocomplete could appear partly off-screen.
   - Edit window creeped to the right when taskbar was on left.
   - Backup didn't start on time.
   - CN could hang on startup while fixing DB integrity errors.

Dec 25, 2013   Version 2.5
   Features:
   - "Remarks" field
     Notes now have a new field "Remarks", intended to collect additional data
     on what is written in the main note body (which quite often is clipped 
     from somewhere).
     The Remarks field adjusts its height automatically to accomodate 
     multiline remarks, however you also can increase its height with your 
     mouse via moving the lower edge of the main text area. 
   - A new search mode has appeared: "Any Text Field", which includes Title, 
     Text, Tags and Remarks.
   - Note export: ability to choose which fields should be exported.
     
   Enhancements:
   - XML import now supports UTF-8 XML files.
   - Upgraded internal DB engine to SQLite 3.8.1.
   - Notes list: Clickable link icons in note preview.
   - Notes list: Improved display of long hierarchical tags.
     Now only the last part of the tag name is displayed by default, the full
     name is displayed in a tooltip when you hover the mouse over the tag.    
   - Tag deletion: provide option to also delete notes with selected tags.
   - New option in internet connection setting: "Use system proxy settings"
   - Added option to clear filters on starting new search: 
     "filters.reset.onnewsearch.enabled".
   - Option to turn off many confirmation messages, implemented as 
     "Don't ask again" checkboxes.
   - Added shortcuts to "File" menu commands: New (Ctrl+E), Open (Ctrl+O), 
     Save As (Ctrl+S), Close (Ctrl+W).
   - Notes list: always scroll to the top of the list on new search.
   - Tag sidebar: scroll to top/bottom of the tag list on arrow double-click.
   - Editor: Alt+Home/End to always navigate to note text's start/end.

   Fixes:
   - Crash on linking notes.
   - Crash on trying to edit a certain note.
   - Intranet URLs were not recognized.
   - Program failed to respond to rapid mousewheel events.
   - Simplenote sync: constant "not completed, try later" when moving remote 
     note to recycle bin.
   - Simplenote sync: deleted synced section appeared again after sync.
   - Simplenote sync: synchronization could constantly fail.
   - Sorting order could be lost for main section.
   - Text and paragraph formats could get corrupted on merging notes.
   - Unable to import XML with more than 3 sections even when "Import 
     sections" was unchecked.
   - Note previews: URL highlight positions could be wrong because of leading
     whitespace.
   - Change shortcuts that use Ctrl+Alt to using other modifiers to avoid 
     collisions with some national keyboard layouts.
   - Notes list: couldn't start search from capital letters or accented 
     characters when search box was not focused.


Sep 17, 2013   Version 2.4
   Features:
   - Enhanced hyperlink support in notes
     Now it is possible to turn any text into a hyperlink targeting either
     an arbitrary URL, a file, or another note.
   - Note properties: display character and word counts
   
   Enhancements:
   - Editor: change title from "Edit 'Smth'" to "Smth (Edit)"
   - Simplenote sync: prevention of duplicates when syncing an exported 
     notebook
   
   Fixes:
   - Simplenote sync: notes containing %25 synced with errors
   - Recycle bin: note with paraformats can't be opened
   - Esc key handling: immediate minimize and non-multistep reset fail when  
       search box has focus
   - Editor: When no text is selected, text formatting shortcuts now toggle 
       formatting for current word only and not whole paragraph
   - Editor: Fixed a numbered list formatting error
   - Editor: Fixed indents being reset on applying list format
   - HTML export: links without protocol prefix didn't work
   - CN could crash on changing notebooks via File menu
   - In some cases a "License Expired" message could be shown on valid 
      license.
   - Tags not assigned to any note were not imported.

Jul 16, 2013    Version 2.3
   Features:
   - New search option "Search across field boundaries"

   Enhancements:
   - Run DB integrity check on every notebook load
   - Simplenote sync: added "server not responding" sync status
   - Recycle bin: show only Cancel button in R/O note editor
   - Editor: Use Alt+L instead of Alt+Down to focus the Link field
   - Added confirmation dialog to merge command
   - Editor: display warning when linked files don't exist
   - Auto fixing of DB indices when damaged
   - Installer: Check free updates expiration date by settings or key date
   - Installer: Restore portable version
   - Options to fine tune the program's behavior on ESC press:
       "filters.reset.onescape.enabled", "filters.reset.multistep",
       "app.mainframe.minimizeonescape.immediate"
   - Option to reset filters on Ctrl+F press:
       "filters.reset.onctrlf.enabled"
   - Option to minimize main window on Enter press:
       "app.mainframe.minimizeonenter"  

   Fixes:
   - Window position not remembered when window has been placed using 
     Win+Left/Right commands in Win7
   - "Download" button is Update dialog sometimes not working
   - Editor: http://test:80 not recognized as URL
   - Recycle bin: exception on trying to paste into R/O note editor
   - Recycle bin: modifying context menu commands should be disabled in R/O 
     note editor
   - Recycle bin: note preview is not closed on ESC
   - Recycle bin: "Read Only Note" dialogs not reused
   - Recycle bin: in the "Read Only Note" dialog, the Close button should be 
      the default.
   - HTML export: hard line breaks are not created
   - Editor: paragraph style is lost on Del press
   - Editor: various undo bugs
   - Editor: some commands raised errors in readonly mode
   - Notes list: note color doesn't change on cut and paste
   - Simplenote sync: can't download note with backslash at end of text
   - Crash on wrong paragraph formatting


May 7, 2013    Version 2.2
   Features:
   - Simplenote sync: support for syncing of multiple sections

   Enhancements:
   - Unified portable and installer versions into one distributive which can be
     installed both ways.
   - Simplenote sync: got rid of "Uid:" lines in synced notes
   - Recycle bin: added column with first non-empty text line from deleted note
   - Recycle bin: view deleted note on double-click.
   - License renewal support

   Fixes:
   - Notes list: note color didn't change when note was moved to another 
     section
   - Reverted back to SQLite 3.7.13 due to performance and stability issues 
   - Recycle bin: note couldn't be restored when section didn't exist
       

Apr 8, 2013    Version 2.1.1
   Enhancements:
   - Recycle bin window size and placement now remembered
   - Increased default font size
   - Added "Request free trial" button to the License dialog
   - Editor: note link caption now updated on Ctrl+Alt+L and Enter
   - Shift+Esc to minimize main window keeping search filters
   - Updated SQLite to version 3.7.16.1
   - Updated translations

   Fixes:
   - SimpleNote sync: plus (+) symbol was syncing incorrectly
   - Simplenote sync: sudden crash during sync
   - Simplenote sync: could cause note edit windows to close all by themselves
   - Notebook upgrade failed if backup folder didn't already exist
   - Recycle bin: first click on "deleted" did nothing
   - Import function didn't check section count limit 
   - Import with sections could cause program crash
   - Note links: possible error on creating new note
   - Editor: note links could get corrupted 
   - Editor: correct copying of note links with text formats
   - Editor: Note was always saved to db when line trimming was on
   - Clipping: active tags of wrong section could be assigned


Mar 19, 2013     Version 2.1
   Features:
   - Recycle bin for notes
     New File/Recycle Bin menu option
   - Backup: added "File/Backup/Backup Now" command     

   Enhancements:
   - Backup: notebook-specific backup settings
   - Simplenote sync: Improved reliability
     (CintaNotes has migrated to the new Simperium API)
   - Added progress bar display to import and export
   - Editor: Context menu for the "Link" field
   - Note links: updating link caption after retargeting the link

   Fixes:
   - Links to notes: import could break local note links
   - Fixed spurious "Synchronization failed" errors
   - Create note link: error on creating new note
   - SN sync sometimes couldn't download all notes
   - Export progress bar never ran to the end
   - Accelerators were not working when modal dialog was open
   - Note links could get corrupted when they were restored from recycle bin 
   - PRIMARY KEY contraint violation on adding note links
   - Simplenote sync: better handling of HTTP error 412
   - CN could suddenly clear all tags and sort order from all sections


Feb 25, 2013     Version 2.0.4 
   Enhancements:
   - More reliable clipping with configurable clip wait time.
     Now with the "clipping.waittime.seconds" parameter in cintanotes.settings
     you can control how long should CN wait for the data to appear in the 
     clipboard.
   - Editor: added section selector control.
   - Editor: added support for recognizing URLs with custom protocols.
     (Now links like onenote:// or evernote:// are recognized.)
   - CN now displays assigned section and tags in the balloon tooltip which 
     appears on silent clipping.
   - Ctrl+Tab/Ctrl+Shift+Tab now can move away from the "All" section selection.
   - Added confirmation message box for the "Register link protocol" command.
   - Display assigned section and tags in baloon tooltip on silent clipping.

   Fixes:
   - Simplenote sync: Fixed authorization failed error.
   - Simplenote sync: Proxy autoconfiguration was not working.
   - Note could be saved into deleted section.
   - Section edit dialog color did not change when picked color changed.
   - Main window caption was not updated on deleting section.
   - Mouse wheel didn't work on notes list when search box had focus.
   - Editor: Ctrl+Tab could corrupt note links.
   - Ctrl+Shift+I started search for Tab character.
   - Editor: Format/Clear changed line height of CJK text.
   - Editor: Line trimming could corrupt note links
   - Error on pressing Delete after switching notebooks.
   - Fixed possible crash while exporting notes.
   - Update notification is now shown only once.
   - Note link tooltip appeared when a context menu was displayed.


Feb 11, 2013     Version 2.0.3 
   Enhancements:
   - Links to notes: show tooltip with target info on mouse hover
   - Added option  "Window/Minimize on Esc"
   - Improved usability of "select next action" message boxes
   - Editor: Improved block indent/unindent behavior
   - Editor: Ctrl+Alt+S to save note without changing modified date  
   - UI for notebook upgrade process and ability to create backup before
     upgrading
   - Passwords to proxy and Simplenote are now stored in encrypted form    

   Fixes:
   - Section view state not always proreply saved and restored
   - Note links couldn't be copied and pasted
   - Editor: Backspace working incorrectly in bullet list
   - Editor: Shift+Enter working incorrectly in bullet lists when line is empty
   - Notes list not always updated after deleting a section
   - Possible error on deleting section
   - SimpleNote sync: possible crash while syncing notes containing raw HTML 
   - Notes list and tag sidebar not updated after deleting all notes with a 
     certain tag
   - Parent tag not created on open/import old db file 
   - "Create New Note" shortcut didn't use the Inbox section
   - Editor: note link commands should be disabled if text formatting is 
     disabled
   - Import: parent tags not created when hierarchic tags are entered into 
     the "Tags to add" field
   - URL not recognized when it contains ":"


Jan 24, 2013    Version 2.0.2 
   Enhancements:
   - Tag sidebar: improved usability with tag filters.
     Added the "No Tag Filter", "Only Used" and "Only Related" context menu
     options to control the tag list display.
   - Sections: Sort and search parameters of each section of each opened 
     notebook are now remembered.
   - Sections: Ctrl+Tab and Ctrl+Shift+Tab are now shortcuts to navigate tabs.
   - Sections: Added Ctrl+Shift+Space as an alternative to Ctrl+` shortcut to 
     select all tabs.
   - Specifying proxy settings for internet connection.
     New menu item "Options/System/Proxy settings"
   - Links to notes: don't display current note's title in the dropdown
   - Links to notes: display 'Delete Note Link' only when the caret is on note
     link
   - Tab widths are now configurable via the "sectionbar.tab.width" parameters
     in the cintanotes.settings file
   - Improved notebook opening error diagnosis
   - Added option "ui.profeatures.hide" to hide paid features in menus
   - Displaying program version in tray tooltip
   - Options/System: Perform UAC elevation instead of just displaying error

   Fixes:
   - Tag sidebar: mouse wheel scrolling not working
   - Slow search and tab switching on notebooks having 1000+ tags
   - Links to notes: failure to focus target note link
   - Links to notes: message dialogs were not modal
   - Simplenote sync: impossible to search while downloading notes
   - Editor: format toggle not always working
   - Editor: wrong text selected after paste + undo
   - Editor: Alt+BkSp not working
   - Editor: caret should be moved on right-click
   - Editor: bullet list stops when ENTER on filled line
   - Editor: formatting is pasted into editor with disabled formatting
   - Editor: undo command removed bullets from lists 
   - Editor: numbers were stripped when pasting plain-text numbered list and 
      text formatting is disabled
   - Editor: text formatting was used for block indents even when text 
      formatting was disabled
   - Possible crash on mouse wheel in search box
   - Possible SQLite Error 14: unable to open database file


Dec 30, 2012     Version 2.0.1
   Enhancements:
   - Multithreaded Simplenote sync: 3-5x increased sync speed
   - Links to notes: Added "Copy Note Link" context menu item to note editor
   - Links to notes: "Create new note" from dropdown now opens the new note 
     for editing
   - Links to notes: the initial contents of the dropdown suggestion edit 
     is initially selected 
   - Support for opening notebooks from command line
   - When clipping from a CN editor window, a cintanotes:// link to note is 
     placed into the Link field
   - Editor: changed strikeout text shortcut to Ctrl+K

   Fixes:
   - Periodic Simplenote sync could lead to crash
   - Simplenote sync: proper syncing of note links
   - Simplenote sync: don't put simple links in <a> tag, use URL recognition
   - Links to notes: right-click on note link behaved unintuitively
   - Links to notes: inserting timestamp into note link broke it
   - Possible crash when running from Program Files (x86)
   - Editor: Ctrl+Alt+Z and Ctrl+Shift+Z shouldn't Undo
   - Possible error on clipping (precondition violation)
   - CN could put Internet Explorer into offline mode
   - Search scope and "search inside words" were not remembered in each section
   - Tags with use count of 0 were not displayed even if marked as not 
     autodeleted
   - Error when saving tag with forward slash as first symbol
   - Possible error on startup when there are many sections and section bar 
     is hidden
   - Editor: "Column uid not unique" error on saving note
   - Notes list: after pasting several notes, only one of them was selected
   - Notes list: Left Click + Wheel scrolled more than page of text
   - Filter control: Ctrl+Down was not working properly 

Dec 19, 2012     Version 2.0
   Features:
   - Simplenote synchronization.
     Finally you can access your notes from your mobile device! 
     (Commercial)
   - Tabbed notebook sections.
     Divide your notebook into colorful sections! (Up to 3 sections in the 
     free version, unlimited number of sections in the licesed version.)
   - Linking notes with each other.
     Now you can link notes together! More than that, now you can place a link
     to a CN note into any rich-text enabled app! (Commercial)
   - Application icon colorization.
     Now the application icon is colored according to selected color theme, 
     which helps to distinguish between icons in the notification area when 
     you run multiple instances of CN.

   Enhancements:
   - Option to associate CintaNotes with .db files.
     The new <em>Options/System/Associate with .db files</em> option (requires
     running CintaNotes with administrator privileges).
   - Editor: Pressing F7 when caret is on a link opens this link.
   - Some performance optimizations in the notes list.
   - Notes list: returned the "New Note" context menu item.

   Fixes:
   - Note editor: fixed undo behavior for block indents
   - Typing search query was possible even when search box was disabled
   - Search field is now enabled regardless of how many notes are found
   - When a child tag is deselected, the parent stays selected if it was 
     selected before.
   - Tag sidebar: Unrelated tags became more readable


Nov 27, 2012     Version 1.8.5
   Enhancements:
   - Keyboard shortcuts to manipulate current tag selection from the search box.
     Ctrl+, Shift+, and Alt+Enter now work from the search box to change current
     tag selection.

   Fixes:
   - Regression: accepting tags on spacebar not working anymore.
   - Regression: Single Ctrl+Enter not enough to apply tags on tag sidebar.
   - Don't focus main window when after closing one editor other gets focused.     
   - "2." not found in note text when note has a title.
   - Note preview: pressing right arrow not always immediately scrolls note's 
     text.
   
Nov 13, 2012      Version 1.8.4
   Enhancements:
   - Put newly opened notebooks to the bottom of the MRU list, not the top.
   - Beep when selecting current notebook in File MRU list.
   - After closing editor, always focus main window.
   - Updated translations.

   Fixes:
   - Unexpected filter reset after modifying note data.
   - Performance problems when rendering large notes.
   - Wrong search highlight positions for text coming after spaces and tabs.
   - URL detection: arbitrary domains were not recognized.


Oct 30, 2012      Version 1.8.3
   Enhancements:
   - New menu option "Help/Debug/Debug Logging"
   - New menu option "Options/Editor/Initial Focus"
   - Updated translations, added new languages: Indonesian, Serbian.
   - Export: Small export dialog enhancements.
   - Editor: trimming spaces also after manual save.
   - Note properties: added settings file option "noteproperties.validatedates"
     to control whether date validation should be performed.

   Fixes:
   - Regression: "-m" command line parameter no longer working.
   - Regression:  Tag sidebar: child tags sometimes not displayed.
   - Editor: problems with copying words from numbered lists to clipboard.
   - Editor: lockup when replacing trailing spaces with newline.
   - Notes list: wrong highlighting of very long tags.
   - CN could crash when Notes List/Render text formatting was unchecked.
   - Tag autocomplete: "abc/b" was not suggested when entering "b".


Oct 15, 2012      Version 1.8.2
   Enhancements:
   - New "-d" command line option to enable detailed debug logging.
   - Editor: no space trimming on manual save, only on closing.

   Fixes:
   - CN version 1.8 and 1.8.1 didn't start up on some PCs.
   - Titles are no longer lost on merging (even if note text is not empty).
   - Wrong sorting order of tags with some national symbols.
   - HTML export: eliminated another reason why notes could get truncated.
   - URLs of the form something,co.XX were not recognized.
   - Fixed "Postcondition failed" error that could come up on clipping.


Oct 2, 2012       Version 1.8.1
   Fixes:
   - Wrong TAB alignment in the notes list.
   - Clipping: only plain text clipboard content was restored after clipping.
   - CN could quit silently several seconds after startup.
   - HTML export: some notes got cut off.
   - HTML export: font from editor.fonts.monospace not used in exported file.
   - Editor: Monospace toggle on text selected with Ctrl+A not working properly.
   - Editor: font unexpectedly turned to monospace after save.
   - Editor: Asian chars appear condensed after save and reopen.
   - Editor: when space trimming enabled, links and text effects got into wrong 
     positions.
   - Editor: URLs with [ and ] characters were not correctly recognized.
   - Note properties dialog: wrong date set when selecting from drop-down 
     calendar.
   - Clipping for copy-pasting text with links from IE could produce text with 
     wrong encoding.
   - About dialog: license label in some languages gets cut off.
   - Registering via clipping the purchase email not working in IE.
   - Entering ".." in Russian locale suggested tags with only one "." in them.
   - Note text could get altered on copy paste.
   - Ctrl+R to toggle the Display Related Tag Only mode was not restricted to
     Personal and Company licenses.
   - Auto updater ignored changes in 4th version digit.


Sep 25, 2012      Version 1.8
   Features:
   - "Expand All/Collapse All" context menu commands in the Tag Sidebar.
   - Keep supported text formatting on clip/paste from rich text enabled
     applications such as MS Word.
   - New commands in note editor:
      F5 to insert current timestamp, Shift+Enter to add a new paragraph to the 
      current list item, Ctrl+Tab and Shift+Ctrl+Tab to indent/outdent text 
      blocks.
      
   Enhancements:
   - The "Display tag counts" feature is now available with the Basic license!
   - Support working with read-only databases.
   - Tag sidebar: Relevant tag marks are now affected also by the text search 
     filter.
   - Tag sidebar: now remembers the last selection when reactivated.
   - Tag sidebar: Click on 'All' now doesn't reset the 'Display related tags 
     only' mode.  
   - Editor: added "editor.trimlines" settings file option to automatically 
     remove trailing line whitespace on save.
   - Display fonts preview in the Note Appearance dialog.
   - Improved tag auto suggestion.
   - "Cut", "Copy", "Paste" and "Delete" context menu items in the search 
     filter box.
   - Double click on a tag in any tag edit field selects the whole tag.
   - Note Properties dialog enhancements.
     Default focus on Created Date, no more on-the-fly date validation.
   - Enhanced system window menu (right-click on app title icon).
   - Ctrl+R to toggle 'Display related tags only' mode.
   - Lists in exported XML and HTML are now be defined by tags.
   - Old tag name to appear in new name field of rename dialog.

   Fixes:
   - Hugely degraded performance on bases with lots of deeply nested tags.
   - Note preview: wrong line breaks for mixed monospace and normal lines.
   - F3 behaved differently in the note editor compared to the notes list
     when having more than one search term.
   - Note properties dialog: created date was not saved for new notes.
   - Strange selected notes after removing tag.
   - Wrong URL highlighting when using german umlauts.
   - Various window focusing issues.
   - Various search related issues.
   - Certain text was disappearing from note preview.
   - Key shortcuts in popup menu were not properly aligned.
   - Crash on search with 0 results + Down Arrow + Alt+Enter.
   - Was not possible to add multiple non-autodeleted tags through the New Tag 
     dialog.
   - Unnecessary tags present in exported XML.
   - On Ctrl+BkSp only first tag was expanded in the Tag Sidebar tree.
   - Buttons in notebook message dialog were too narrow for some languages.
   - Strange tag display when searching with 0 results and
     "Display related tags only" is on.
   - Not possible to switch 'display related tags only' mode with negated 
     tag selection.
   - Tags disappear on Alt+Click when 'Display only related tags' mode is on.
   - Wrong indentation of wrapped bullet list lines.
   - Numbered list numbers could not be deleted with DEL.
   - Editor: Table formatting was not stripped on paste.
   - Removed repeated parent tags in exported HTML.
   - Editor window repaint artefacts when opening a specific note maximized.
   - Editor: dates label not painted if window configured to open maximized.
   - Wrong line breaking in note preview for specific text.    


Jul 14, 2012      Version 1.7.1
   Enhancements:
   - Updated translations.
   - Updated help.

   Fixes:
   - Fixed crash on searching for "/".
   - Case change in tag names using Rename command was not possible.
   - Note selection painting was wrong if note didn't have text and tags. 


Jul 9, 2012       Version 1.7
   Features:
   - [Commercial] Tag hierarchy
     Ability to define hierarchical tags using the "/" symbol.
     CintaNotes will automatically assign parent tags when you assign children,
     and remove children when you remove parents.
   - [Commercial] "Display Related Tags Only" mode for the Tag sidebar
     This mode makes it really easy to focus on what's important at the moment -
     only tags related to the current tag selection are displayed.     
   - Tag properties dialog.
     Right-click on a tag on the Tag sidebar and choose "Properties...".
   - Possibility to create tags not associated with notes.
     Uncheck the "Delete automatically" tag property to make a tag permanent
     (tags created via "New" and "New Child" context menu commands are permanent 
     by default).
   - Note properties dialog to edit note's timestamps.
   - "Check for Updates" command.
   - Automatic update check.

   Enhancements:
   - New option: "Options/Startup/Restore last tag selection".
   - New option: "Options/Tags/Accept On/Single mouse click".
   - Tooltips for some commands.
   - Toggling of tag count display in the Tag Sidebar's context menu.
   - Compiled with support for SSE instructions.
   - Add/Remove tags dialog: Remove tags field now only suggests tags which are 
     present in the note.
   - Minor visual changes: note selection has been made more prominent, 
     crossed out tags are now less bright.
   - To avoid problems while searching, accepting suggestions on spacebar 
     now doesn't apply to the search box.
   - New shortcuts for Tag sidebar:
     Ctrl+Alt+Click crosses out all tags except the clicked one (to display notes 
     having this tag only and no other tags);
     Shift+Alt+Click crosses out all children of a parent tag (to display notes 
     having this parent tag but not having any of the child tags). 

   Fixes:
   - Pasting notes into other apps was not working under some circumstances.
   - Exception when notebook path access was denied.
   - HTML export didn't specify encoding with a byte order mark, which could 
     lead some browsers to display the file with wrong encoding.
   - Editor: Ctrl+Left/Right selection ignored international characters like 
     German umlauts.
   - Wrong line breaking in text preview with Courier font.
   - Editor: Title text got clipped on mouse hover (in XP).
   - Editor: Undo/redo for text formatting worked only when you pressed 
     Ctrl+Z(Y) many times.
   - Label controls flickered on window move.
   - Editor: "something.xy" was recognized as a hyperlink regardless if .xy was
     a real top level domain.
   - F11 shortcut was not displayed in File/Export menu item.
   - Fixed wrong wrapping of East-Asian characters in the note preview.
   - URLs were not saved when clipping from Opera 12 x64.
   - Notes having only titles were lost on merging.
   - "Options/Startup/Run at system startup" could display wrong state.
   - Wrong message about "inaccessible path" in case of newer notebook file 
     version.


May 14, 2012      Version 1.6.2
   Enhancements:
   - Ability to tag imported notes: "Add tags" field in the import dialog.
   - Licensed version is now fully portable.
     License key file is written into the CintaNotes folder. Only if the write
     into this folder fails (when e.g. the folder is inside of Program Files),
     the Application Data folder is used.

   Fixes:
   - Editor window could open on wrong monitor in a multi-monitor system.
   - Editor: Pasting from MS OneNote was not working.
   - Search for "-word" with "Search inside words" ON produced wrong results.
   - Fixed lost portability because of storing absolute paths to .db files:
     now relative paths are used for .db files located in the application folder 
     and below.
   - Fixed SQLite syntax error on searching for "|".
   - Fixed possible "Internal protection error" problem.
   - Automatic notebook reloading was not properly working, which could hinder
     DropBox sync.
   - Fixed wrong editor window positioning when closed while partly off-screen.
   - Tag highlight highlighted "|" even when it meant OR.
   - Fixed huge search performance drop when using the OR operator ("|").
   - Fixed CN crash at startup if notebook drive was inaccessible.
   - Fixed exception on closing notebook if the next file in MRU list had been 
     deleted.
   - Fixed tags filter resetting after clipping even with "Assign active tags" 
     option.

Apr 24, 2012      Version 1.6.1
   Enhancements:
   - Note Editor: title is now displayed with font configured for title in 
     "Options/Notes List..."
   - Ctrl+Enter in search field shouldn't clear non-matches
   - Ctrl+Delete in the note editor to delete the current note
   - Alt+Enter to open the note editor and close the main window
   - Ability to view exported file after export
   - Ignore empty lines on license recognition
   - Tag counters became less obtrusive
   - Improved notebook opening and switching speed

   Fixes:
   - Fixed tag and text filters resetting after a timeout
   - Pre-filtering with tag filter now always improves search speed
   - Fixed regression: Crash on Ctrl+Enter in empty search field
   - Fixed regression: Import from XML slower in 1.6 than in 1.5.7
   - CN rewrote settings file on every run AND close, even if no settings changed
   - Fixed 125% DPI rendering problems
   - Fixed "Column name is not unique" error on adding tag "__"
   - Clipping from XChat was not working
   - Tag search highlighted only first match
   - Fixed incorrect tag rendering if tag name contained '&'

Apr 10, 2012      Version 1.6
   Features:
   - [Commercial] Multiple notebooks support:
      CintaNotes now has the "File/Open" and "File/Save As..." commands, and 
      also has the recently opened files list to easily switch between 
      different DB files. The name of the currently opened DB file is 
      displayed in the main window title (unless it is "cintanotes.db").
   - [Commercial] Ctrl+Enter shortcut to paste note text into currently active 
     application.
   - [Commercial] Exporting notes to HTML format.
   - [Commercial] Tag sidebar can now display tag usage counts.
       This allows you to easily see which tags are underused and can be 
       merged or removed. Tag count display can be turned off in Options/Tags 
       menu.
   - Unified and consistent search behavior:
       Search behavior is now unified and consistent. "Exact search" mode has 
       been removed. Instead there's an option to search inside words. Now you 
       can always use the logical operators: space as AND and '|' as OR. 
       If you need to search for an exact quote, put it in doublequotes, like
       this: "to be or not to be".
   - Support for mixed case tags.
   - "Cut" command for notes, and custom clipboard format to transfer notes from
      one notebook to another while keeping text formatting.
   - New "Help/License" dialog to manage product licensing:
       The dialog includes ability to automatically fill licensing data from
       clipboard and also via clipping.

   Enhancements:
   - Tag sidebar can now be resized with the mouse.
   - New Options/Tags submenu to configure tagging options.
   - New option: "Options/Clipping/After Clipping/Assign currently active tags".
       When this option is on, newly clipped notes are automatically assigned
       tags which are currently selected on the Tag Sidebar.
   - Note editor: Alt+C now works as shortcut for "Cancel".
   - Ctrl+U shortcut for displaying untagged notes.
   - Last used export format is now remembered in settings.
   - Note export scope parameters in the export dialog.
   - Main menu reorganization. "Note Appearance" menu item moved to the Options 
     menu.
   - The executable is now signed with a digital signature.
   - Proper metadata and version information in the executable.
   - Note export dialog now includes the "Export scope" groupbox.
   - Ctrl+Home/End in search box to focus note list and go to first/last note.

   Fixes:
   - Eliminated possibility of painting artefacts on window maximization.
   - Full-text search was not working for East-Asian languages.
   - Searching for "-a" lead to a "Malformed MATCH expression" error.
   - Search could produce wrong results if query contained punctiation or 
      delimiter characters.
   - Copy/pasting note in the notes list lost text formatting.
   - Pasting text in main window didn't recognize links.
   - Removed redundant formatting tags in exported XML file.   
   - Non-ASCII characters in page URLs were corrupted on clipping.
   - USB stick could not be safely removed after note import or export.
   - Restoring focus after clipping was not working in Opera.
   - Note editor: wrong window position after being mazimized.
   - Note editor: lower pane height changed on Ctrl+S.
   - Note editor: applying formatting cleared existing formatting.
   - Note editor: pressing Enter twice didn't cancel bulleted and numbered 
     lists.
   - Note editor: Undo behavior was incorrect after pasting text from clipboard.
   - Note editor: pressing F7 when Link is empty opened Windows Explorer.


Mar 20, 2012    Bugfix release: 1.5.7
   Enhancements:
   - Updated translations.

   Fixes:
   - Daily backup scheduling was broken, CN was constantly doing daily backup.
   - Note editor was not reused for new notes after manual save, what could lead
     to losing newly entered data.
   - Fixed std::out_of_range error on pressing Ctrl+BkSpc in title/tags/link 
     fields.
   - It was not possible to clip text from CN editor window.
   - Editor: Underlined text style was lost when pasting from clipboard.


Feb 20, 2012    Bugfix release: 1.5.6
   Enhancements:
   - Note editor: placed last modification date under the creation date for 
      easier comparison.
   - Note editor: activating links with Ctrl+Click.
   - Updated translations.
 
   Fixes:
   - Note editor: F3 and Shift-F3 keys for find next/previous were not working 
      (regression).
   - Note editor: creation and modification time labels were not updated on 
      Ctrl+S. 
   - Note editor: the "Note saved" message on Ctrl+S was not always visible.
   - Note's last modified date always changed if note font was the same as 
      the configured monospace font.
   - Replaced confusing error message on trying to import a non-existent .db 
      notebook file with a more user-friendly one.
   - Notes could be lost when merged while sorted by modified order.
   - Fixed non-intuitive date assignment behavior on creating and saving notes.
   - Fixed distorted painting of note title's search highlights if max preview 
     text lines was set to 0.
   - Fixed possible crash when importing notes from older .db files.

Feb 7, 2012     Version 1.5.5
   Features:
   - Configuring how the note's timestamp is displayed in the notes list.
     You can set whether creation of modification time should be displayed
     (or both), and also if the time of day needs to be displayed.
   - Searching by modification time.
     New search mode has been added.

   Enhancements:
   - Improved speed of XML import and export.
   - Display of note creation and modification time in the editor.
     (You can turn this off using the "editor.displaydates" parameter in
     cintanotes.settings.)
    
   Fixes:
   - Main window was not visible after single tray icon click if 
      "Minimize to tray" was not set.
   - USB stick could not be safely removed after note import or export.
   - Importing .db could modify the source file if it was from an older 
      CintaNotes version.
   - Note last modification date was not exported to XML and imported from it.
     In order to export to an XML file readable by CintaNotes 1.5.4 and
     earlier, you need to use the special "XML for CintaNotes 1.5.4" format.   
   - Sort order by modification date was broken after importing from XML.
   - Note's modification time always changed if note had a styled link.
   - Text search could crash the app. 
     When maximum text preview lines was set to 1.
   - It was impossible to select an italic font in the Note Appearance dialog.

                 
Jan  12, 2012     Version 1.5.4
   Features:
   - Sorting notes by last modification date

   Enhancements:
   - Updated translations
   
   Fixes:
   - Note editor: fixed wrong Ctrl+S behavior on new notes
   - Tags didn't always fit into the tac AC dropdown
   - Fixed out_of_range error when pressing Ctrl+BkSp in empty search box
   - Removed unnecessary empty space on the bottom of the tag AC dropdown
   - Notes list: Some note titles could appear clipped
   - Note editor: Unsupported paragraph formatting was not cleared on paste
   - Note editor: In title edit box letters could appear clipped on the bottom
   - Window position was not saved if "Always on top" was set


Dec  14, 2011   Version 1.5.3
   Enhancements:
   - Text highlight color and monospace font are now configurable
     in .settings file.
   - Ctrl+S in note editor to save note immediately
   - Ctrl+Enter in empty search box to view untagged notes

   Fixes:
   - Fixed error when changing language while editing new notes
   - Fixed crash on pressing Ctrl+Bksp on a note without tags
   - Maximized state of main and editor windows was not saved in settings file
   - Note editor: When editing note title Ctrl+Alt+Key shortcuts were recognized as Ctrl+Key
   - Note editor: Pressing Enter with non-empty selection resulted in wrong selection
   - Note editor: Ctrl+Backspace did not function in title and tags
   - Note editor: Dates were recognized as numbered lists
   - Note editor: Empty lines were selected wrongly
   - It was impossible to use bold variants of some fonts
   - Note editor: Text copy-pasted into the note from PDF received highlight
   - Wrong note duplicate recognition at import

  
Nov 14, 2011   Version 1.5.2

   Enhancements:
   - Tag autocomplete now matches any word in multi word tags.
     Words within tags can be delimited by many common non-alphabetic characters,
     like this: "my-tag", "projects/cintanotes", "prio:high", "cn_rocks".
   - New option "Options/Editor/Auto-Indent" which controls whether a new line
      in editor gets automatically indented like the previous one.
   - Turning off Options/Editor/Text Formatting now warns about possible loss 
      of text formatting (if notebook contains notes with formatting).
   - Note editor: if nothing is selected, Ctrl+Del clears formatting of the 
      whole current paragraph.
   - Updated translations.

   Fixes:
   - Search highlight positions could be wrong because of tabs.
   - Note editor: links were still highlighted even when "highlight links" was off.
   - Resolved performance issues with XML import.
   - Eliminated possible crash on XML export.
   - Layout of "Preview min max lines" option labels was not suited for all languages.
   - CN could fail to start on WinXP 2002 SP2 with large font sizes.
   - Note editor: URL highlighting could get broken
   - Note editor: "Monospace" and "Highlight" text styles were lost on copy-pasting.

Nov 3, 2011    Version 1.5.1

   Features:
   - Basic text formatting support in notes editor.
     You can now format text in notes editor. Bold, italics, underline, 
     strikeout, monospace and highlighting are supported. Also you can make
     bulleted and numbered lists.
     Text formatting support is optional and can be turned off in the 
     Options / Editor menu.
   - Notes list can display formatted text in note preview.
   - Import and export of text formatting to and from XML.
   - New "Option/Startup" submenu with two options which previously has been 
     available only via manual editing of the .settings file:
     "Run Minimized" - makes CintaNotes run minimized to tray;
     "Allow Multiple Instances" - use this to run many copies of CN 
     simultaneously.

   Enhancements:
   - Refreshed program icons and logo, by a professional designer.
     (The program icon doens't look ugly on Windows 7 taskbar anymore!)
   - Tab characters now don't get autoconverted to spaces.
   - Updated "About CintaNotes" dialog.
   - Display of a descriptive message when trying to load unknown new 
     version of the notebook file.

   Fixes:
   - Search: click on a note used to erroneously accept tag suggestion.
   - XML export without specifying 'XML' extension could lead to failure.
   - When editing note title Ctrl+Alt+Key shortcuts were not recognized.
   - German umlaute in tags were not lowercased correctly.


Apr 7, 2011    1.4.3 Version Released!

   Features:
   - Added the "Notebook Parameters" dialog, which allows to setup the notebook
     file path, adjust synchronization settings, and move current notebook to 
     another location. The dialog box is called up with the "File/Notebook..." 
     menu item. 
   - Added translations of the UI into Hungarian, Lithuanian, Slovenian and
     Spanish languages. 
   - Added the "Help/Translations" menu item, which is a link to the 
     collaborative UI translation center based on the Transifex online service.
   
   Enhancements:
   - Updated translations: Chinese Traditional, Japanese.
   
   Fixes:
   - File "log.txt" was created when the "lang" folder was not found
   - Backup folder was created even when all backup was turned off
   - Note editor: the text area is now always initially focused in case text 
      search has been active
   - "Show main window hot key" didn't work when the startup.minimized parameter 
     was set.
   - When startup.minimized was set, CintaNotes started up minimized when the
     user was changing UI language.


Feb 14, 2011    1.4.2 Update Released!

   Features:
   - Added translations of the UI into Danish, Portuguese, Korean and Traditional 
     Chinese.
   - F3 and Shift+F3 now work in note editor to find next and previous instances
     of currently selected text.

   Enhancements:
   - CintaNotes loads new language files automatically.

   Fixes:
   - Fixed error "ios_base::failbit set" after installing into Program Files when
     run installer as admin and agreed to lauch CintaNotes after install.
   - CintaNotes crashed if 'Lang' subfolder didn't exist.


Feb 2, 2011     Version 1.4.1 Release

   Features:
   - Translations of the UI into Chinese, Belarusian, French, Italian, Japanese 
     and Polish.  

   Enhancements:
   - Enhanced search highlights in note preview.
      Now you can navigate search matches using both forward and backward using 
      the F3 and Shift+F3 keys, and match counts in the form of "current/total" 
      are displayed (can be turned off via the 
      noteslist.search.highlights.displaycounts option in the settings file).
   - A number of new parameters in the settings file:
      1) Option to pick whether note's title or text is initially focused in the 
         editor via the "editor.focus.title" parameter.
      2) The -i, -m, -noactivationmsg command line parameters are now backed
      up by "startup.multipleinstances.allowed", "startup.minimized" and
      "startup.multipleinstances.activationmsg" parameters in the settings file.

   Fixes:
   - Regression: "-m" command line parameter didn't work
   - Crash when middle-clicking on tag while no notes displayed
   - Extra " "(space) symbol at the beginning of the Tags field in editor
   - Extra empty lines when scrolling in note editor using mouse wheel
   - Error when moving notes while text search is active
   - Changing language would lose unsaved notes
   - A number of minor fixes

Jan 19, 2011    Version 1.4 Release

    Features:
    - Support for multiple languages in UI
        Now CintaNotes UI supports languages other than English! The 
        translations to German and Russian are bundled with this release.
        You can switch current language with the "Options/Language" menu.
        More languages are to come. If you'd like to have CintaNotes in 
        your language, please edit the "CintaNotes\lang\en.lang" file 
        and send it to feedback@cintanotes.com.
    - Scroll long notes via holding a spacebar to "pin" them
        Reading long notes in notes list using just the left and right 
        arrow keys was not convenient. Now the note can be "pinned" 
        using spacebar (or left mouse click), and the text can be scrolled 
        with all usual navigation keys or mouse wheel.
    - Configurable clipping options regarding note title.
        Now whether the title of a clipped note is the window title, 
        first line of text or blank is controlled with the 
        "Options/Clipping/Use as Title" menu.
    - "Show similarly tagged" command on Ctrl+BkSp
        This command changes the tag selection on the tag sidebar to match 
        the tags of currently focused note.

    Enhancements: 
    - The editor now opens the note scrolled to the same place in text where 
      the note preview was.
        Also if a search was active, the search term is highlighted.
    - Ability to jump to next/previous page in note preview on Ctrl + Left/Right 
      arrow.
    - "Activated already running CN instance" message box is now optional.
        CintaNotes now supports the "-noactivationmsg" command line 
        parameter which suppresses the message box which appears when you 
        start CN with it already running. 
    - Swapped F7 and F3 keyboard shortcuts. 
        F7 now opens the note's link, and F3 now means "find next", which is
        a common convention. 
    Fixes:
    - Emails were highlighted incorrectly 
    - Tray icon disappeared after Exporer crash on Win7 x64
    - Ctrl+A was not working in note edit dialog Title, Tags and Link fields on WinXP
    - Scrollbar was not visible in tag autocomplete dropdown list
    - Large texts (>64Kb) could not be edited
    - SQLite Error 14: unable to open database file on Win7 x64
    - XML import: CintaNotes could hang while importing XML with extra spaces 


Nov 1, 2010 Version 1.3 Release

    Features: 
    - Automatic highlighting of links inside notes. The following types of
          links are currently recognized:
           http://cintanotes.com/something
           http://www.cintanotes.com/something
           cintanotes.com/something
           ftp://cintanotes.com/something
           https://cintanotes.com/something
           mailto:feedback@cintanotes.com
           file:///c:\windows\system32\calc.exe
        - Reopening not explicitly closed note windows on program restart

    Enhancements: 
    - Ctrl+Home/End for going to first/last line of text in the editor from any control
        - Ctrl+Enter in search box for transforming tag search into tag sidebar selection.
    - Text in the search field gets selected when pressing "Ctrl+F"
    - Tag autocomplete automatically adds space at the end
    - Removed legacy CintaNotes Beta (.dat) notebook support to reduce executable size.

    Fixes:
    - Crash when pressing Ctrl+Break
    - Empty notes were not deleted automatically on ESC press
    - Crash on closing from tray menu with open note editor window(s)
    - SQLite error while pasting text from Scintilla-based editors
    - Long tags didn't fit into autocomplete popup
    - Control resizing bug when started maximized
    

Jul 19, 2010    Version 1.2 Release

    Feature: Open multiple editor windows   
    Now the main window is accessible when you are editing a note, and you
    can view several notes side-by-side.

    Enhancement: Trimming leading and trailing whitespace from the clipped text 
    is now optional (the clipping.trimwhitespace parameter in the 
    cintanotes.settings file).

    Enhancement: Added the roadmap link to the Help menu.

    Fix: Moving notes was very slow on USB sticks.

    Fix: Clipping URLs did not work in Opera 10.60 and Opera AC

    Fix: Whitespace trimming happened after each editing instead of just 
    clipping.


Jun 18, 2010    1.1C Update

    Enhancement: Import command filters out duplicate notes.
    Fix: Crash while searching when max preview lines parameter is set to 0


Jun 16, 2010    Version 1.1 Release

    Feature: DropBox synchronization without closing the program
        Put cintanotes.db into your DropBox folder and it will be automatically
        synchronized across of all your PCs. And now you don't have to remember
        to close CintaNotes before leaving!

    Feature: Ability to exclude tags from search
    Exclude tags via Alt-clicking on them in the tag sidebar (tag OR mode is
    using Shift-click now)

    Feature: The '-i' command line switch allows to run different instances of 
    CintaNotes simultaneously

    Enhancement: Awesome new icons, kindly contributed by Alessandro Onorati!
    Enhancement: Note previews are auto-scrolled to the first search highlight
    Enhancement: You can use F7 to cycle through focused note's search 
    highlights

    Enhancement: New keyboard shortcuts: Ctrl+Ins and Shift+Ins for Copy/Paste, 
    Ctrl+N to add new note 
   
    Fix: Exception while scrolling if note is higher than viewport
    Fix: Backup folder was created even if all backup was turned off
    Fix: Possible exception when moving to bottom with active tag filter
    Fix: Main window resize bug after making tag sidebar visible    
    Fix: Possible exception when tagging multiple notes
    Fix: Crash during export if tag filter active
    Fix: Esc didn't minimize if there were no notes


Mar 17, 2010    1.0B Update

    Enhancement: Added keyboard shortcuts for sorting
    Fix: Fixed sorting control redrawing issue
    Fixed runtime error at startup for non-administrative accounts


Mar 16, 2010    CintaNotes 1.0A Hot Fix

    Fix: Fixed possible runtime error at startup.
    Some minor fixes.

Mar 15, 2010    Version 1.0 Release

    Feature: Migrated to SQLite as main notes database
    Feature: Note sorting
    Feature: Automatic import of Beta .dat files at first start
    Feature: Full text search with extended query syntax
    Enhancement: New parameters in the .settings file, most notably 
        "notebook.file" which allows to specify any path to the notebook file
    Minor bugfixes

Oct 16, 2009    Hotfix: Beta M10.5
  
    Fix: Page URL was not captured if the "Open in Editor" option was set.

Oct 14, 2009    Beta M10.4 Update

    Enhancement: Added minimum number of note preview text lines option.
    Enhancement: Added alpha separator lines to tag sidebar.
    Enhancement: F3 for browsing link now works in note editor.
    Enhancement: Clipped notes are now discarded on "Cancel".
    Enhancement: "Copy" command now copies only note text. To include note time and title,
                use Ctrl+Alt+C.
    Enhancement: No URL check in note editor, any runnable link is allowed.
    Enhancement: Pasting a note adds active tags to it so that it stays in view.
    Enhancement: Pressing Esc in note editor is the same as pressing OK - no more accidental data 
                loss. If you want to discard changes, press the "Cancel" button.
    Fix: CintaNotes didn't work with Actual Window Manager.
    Fix: It was not possible to select text in note editor if CintaNotes was inactive.
    Fix: Note merging now uses notes' time to determine ordering and thus works correctly in 
                reversed order view.
    Fix: Pressing Del crashed CN when viewing an empty tag intersection.
    Fix: Runtime Exception when searching for consecutive spaces.
    Fix: Paste command didn't respect reverse order view and focused wrong note.
    Fix: Wrong note was focused after deleting several notes.
    Fix: Keyboard could be blocked when editor opened after clipping.
    Fix: Selecting text with Shift+Down in note editor didn't go to the end.
        
         
Sep 14, 2009    Beta M10.3 Update

    Enhancement: Automatic reloading of changed notebook file. 
        If you use services like DropBox or Syncplicity to synchronize your 
        CintaNotes notebooks, this will protect the newer version of the 
    notebook from being overwritten with the old version (this could 
    happen if you kept CintaNotes running on two or more PCs 
    simultaneously).

    Fix: CintaNotes hang when you used the clipping function while having the 
    note editor active and the "Open in Editor" option turned on.


Aug  3, 2009    Beta M10.2 Update

    Fix: After creating a new note with the "Reverse Order" option enabled, the 
    focus went to the oldest note instead of the newly created one.


Jul 26, 2009    Beta M10.1 Update 

    Fix: Notebook file could become corrupt when being saved to a USB stick.
    Fix: Minor correction to portable upgrade instructions in readme.txt.


Jul 23, 2009    Beta M10 Released

    Feature: AND and OR modes for tag sidebar
        Ctrl-clicking on a tag means AND and Alt-clicking means OR.
        When in OR mode, the highlight is yellowish. As for now, the modes
        are mutually exclusive.

    Feature: More advanced backup scheme - hourly, daily and weekly backups      
        CintaNotes now creates three backup files: notebook.hourly.dat is 
        updated each hour, notebook.daily.dat - each day, and 
        notebook.weekly.dat is updated once per week.

    Feature: "View / Reverse Order" command reverses the notes in the list
        so that latest notes come first 

    Enhancement: Tag autocomplete in search box is now limited to Anywhere 
        and Tags search modes
        
    Enhancement: Option to edit note immediately after each clipping 

    Enhancement: Switching to Untagged after clipping is now optional 

    Enhancement: Focus is not reset if current note stays in view after 
        searching or cancelling search 
        
    Enhancement: Autocomplete suggestions are not hot-tracked in the text 
        box anymore 
    
    Fix: Note editor: focus was not restored at activation

    Fix: Clipping while a note is open and then pressing OK caused CN to 
        crash 
        
    Fix: Tag autocomplete dropdown could go off-screen 
