<ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
        <a href="myaccount.php" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
        </a>
    </li>
    <li class="nav-item nav-category">Manual Listings</li>
    <li class="nav-item">
        <a href="add_new_listing.php" class="nav-link">
        <i class="link-icon" data-feather="chevron-right"></i>
            <span class="link-title">Add New Listing</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="view_active_listings.php" class="nav-link">
        <i class="link-icon" data-feather="chevron-right"></i>    
        <span class="link-title">View Active Listings</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="view_inactive_listings.php" class="nav-link">
            <i class="link-icon" data-feather="chevron-right"></i>
            <span class="link-title">View Inactive Listings</span>
        </a>
    </li>
    <li class="nav-item nav-category">Library</li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false" aria-controls="uiComponents">
            <i class="link-icon" data-feather="feather"></i>
            <span class="link-title">File Store</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="uiComponents">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="upload.php" class="nav-link">Upload</a>
                </li>
                <li class="nav-item">
                    <a href="search.php" class="nav-link">Search</a>
                </li>
                
            </ul>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#advancedUI" role="button" aria-expanded="false" aria-controls="advancedUI">
            <i class="link-icon" data-feather="anchor"></i>
            <span class="link-title">Newsletter</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="advancedUI">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="scroll_newsletter.php" class="nav-link">Scroll Subscribers</a>
                </li>
            </ul>
        </div>
    </li>
   
    <li class="nav-item nav-category">Content</li>
    <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#general-pages" role="button" aria-expanded="false" aria-controls="general-pages">
            <i class="link-icon" data-feather="book"></i>
            <span class="link-title">Website Pages</span>
            <i class="link-arrow" data-feather="chevron-down"></i>
        </a>
        <div class="collapse" id="general-pages">
            <ul class="nav sub-menu">
                <li class="nav-item">
                    <a href="wp_contact.php" class="nav-link">Contact page</a>
                </li>
               
            </ul>
        </div>
    </li>
    <li class="nav-item nav-category"><a href="mailto:sai@livewd.ca">Help</a></li>
    <?php if($user->hasPermission("admin")){?>
    <li class="nav-item nav-category"><a href="mailto:sai@livewd.ca">Help</a></li>
    <?php } ?>
</ul>