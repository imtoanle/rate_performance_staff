<div class="row">
    
    <!-- Profile Info and Notifications -->
    <div class="col-md-6 col-sm-8 clearfix">
        
        <ul class="user-info pull-left pull-none-xsm">
        
                        <!-- Profile Info -->
            <li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
                
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset('assets/images/thumb-1@2x.png')}}" alt="" class="img-circle" width="44" />
                    {{ Sentry::getUser()->username }}
                </a>
                
                <ul class="dropdown-menu">
                    
                    <!-- Reverse Caret -->
                    <li class="caret"></li>
                    
                    <!-- Profile sub-links -->
                    <li>
                        <a href="../timeline/index.html')}}">
                            <i class="entypo-user"></i>
                            Edit Profile
                        </a>
                    </li>
                    
                    <li>
                        <a href="{{asset('mailbox/main/index.html')}}">
                            <i class="entypo-mail"></i>
                            Inbox
                        </a>
                    </li>
                    
                    <li>
                        <a href="../calendar/index.html')}}">
                            <i class="entypo-calendar"></i>
                            Calendar
                        </a>
                    </li>
                    
                    <li>
                        <a href="index.html#">
                            <i class="entypo-clipboard"></i>
                            Tasks
                        </a>
                    </li>
                </ul>
            </li>
        
        </ul>
                
        <ul class="user-info pull-left pull-right-xs pull-none-xsm">
            
            <!-- Raw Notifications -->
            <li class="notifications dropdown">
                
                <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-attention"></i>
                    <span class="badge badge-info">6</span>
                </a>
                
                <ul class="dropdown-menu">
                    <li class="top">
    <p class="small">
        <a href="index.html#" class="pull-right">Mark all Read</a>
        You have <strong>3</strong> new notifications.
    </p>
</li>

<li>
    <ul class="dropdown-menu-list scroller">
        <li class="unread notification-success">
            <a href="index.html#">
                <i class="entypo-user-add pull-right"></i>
                
                <span class="line">
                    <strong>New user registered</strong>
                </span>
                
                <span class="line small">
                    30 seconds ago
                </span>
            </a>
        </li>
        
        <li class="unread notification-secondary">
            <a href="index.html#">
                <i class="entypo-heart pull-right"></i>
                
                <span class="line">
                    <strong>Someone special liked this</strong>
                </span>
                
                <span class="line small">
                    2 minutes ago
                </span>
            </a>
        </li>
        
        <li class="notification-primary">
            <a href="index.html#">
                <i class="entypo-user pull-right"></i>
                
                <span class="line">
                    <strong>Privacy settings have been changed</strong>
                </span>
                
                <span class="line small">
                    3 hours ago
                </span>
            </a>
        </li>
        
        <li class="notification-danger">
            <a href="index.html#">
                <i class="entypo-cancel-circled pull-right"></i>
                
                <span class="line">
                    John cancelled the event
                </span>
                
                <span class="line small">
                    9 hours ago
                </span>
            </a>
        </li>
        
        <li class="notification-info">
            <a href="index.html#">
                <i class="entypo-info pull-right"></i>
                
                <span class="line">
                    The server is status is stable
                </span>
                
                <span class="line small">
                    yesterday at 10:30am
                </span>
            </a>
        </li>
        
        <li class="notification-warning">
            <a href="index.html#">
                <i class="entypo-rss pull-right"></i>
                
                <span class="line">
                    New comments waiting approval
                </span>
                
                <span class="line small">
                    last week
                </span>
            </a>
        </li>
    </ul>
</li>

<li class="external">
    <a href="index.html#">View all notifications</a>
</li>               </ul>
                
            </li>
            
            <!-- Message Notifications -->
            <li class="notifications dropdown">
                
                <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-mail"></i>
                    <span class="badge badge-secondary">10</span>
                </a>
                
                <ul class="dropdown-menu">
                    <li>
    <ul class="dropdown-menu-list scroller">
        <li class="active">
            <a href="index.html#">
                <span class="image pull-right">
                    <img src="{{asset('assets/images/thumb-1.png')}}" alt="" class="img-circle" />
                </span>
                
                <span class="line">
                    <strong>Luc Chartier</strong>
                    - yesterday
                </span>
                
                <span class="line desc small">
                    This ain’t our first item, it is the best of the rest.
                </span>
            </a>
        </li>
        
        <li class="active">
            <a href="index.html#">
                <span class="image pull-right">
                    <img src="{{asset('assets/images/thumb-2.png')}}" alt="" class="img-circle" />
                </span>
                
                <span class="line">
                    <strong>Salma Nyberg</strong>
                    - 2 days ago
                </span>
                
                <span class="line desc small">
                    Oh he decisively impression attachment friendship so if everything. 
                </span>
            </a>
        </li>
        
        <li>
            <a href="index.html#">
                <span class="image pull-right">
                    <img src="{{asset('assets/images/thumb-3.png')}}" alt="" class="img-circle" />
                </span>
                
                <span class="line">
                    Hayden Cartwright
                    - a week ago
                </span>
                
                <span class="line desc small">
                    Whose her enjoy chief new young. Felicity if ye required likewise so doubtful.
                </span>
            </a>
        </li>
        
        <li>
            <a href="index.html#">
                <span class="image pull-right">
                    <img src="{{asset('assets/images/thumb-4.png')}}" alt="" class="img-circle" />
                </span>
                
                <span class="line">
                    Sandra Eberhardt
                    - 16 days ago
                </span>
                
                <span class="line desc small">
                    On so attention necessary at by provision otherwise existence direction.
                </span>
            </a>
        </li>
    </ul>
</li>

<li class="external">
    <a href="{{asset('mailbox/main/index.html')}}">All Messages</a>
</li>               </ul>
                
            </li>
            
            <!-- Task Notifications -->
            <li class="notifications dropdown">
                
                <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <i class="entypo-list"></i>
                    <span class="badge badge-warning">1</span>
                </a>
                
                <ul class="dropdown-menu">
                    <li class="top">
    <p>You have 6 pending tasks</p>
</li>

<li>
    <ul class="dropdown-menu-list scroller">
        <li>
            <a href="index.html#">
                <span class="task">
                    <span class="desc">Procurement</span>
                    <span class="percent">27%</span>
                </span>
            
                <span class="progress">
                    <span style="width: 27%;" class="progress-bar progress-bar-success">
                        <span class="sr-only">27% Complete</span>
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a href="index.html#">
                <span class="task">
                    <span class="desc">App Development</span>
                    <span class="percent">83%</span>
                </span>
                
                <span class="progress progress-striped">
                    <span style="width: 83%;" class="progress-bar progress-bar-danger">
                        <span class="sr-only">83% Complete</span>
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a href="index.html#">
                <span class="task">
                    <span class="desc">HTML Slicing</span>
                    <span class="percent">91%</span>
                </span>
                
                <span class="progress">
                    <span style="width: 91%;" class="progress-bar progress-bar-success">
                        <span class="sr-only">91% Complete</span>
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a href="index.html#">
                <span class="task">
                    <span class="desc">Database Repair</span>
                    <span class="percent">12%</span>
                </span>
                
                <span class="progress progress-striped">
                    <span style="width: 12%;" class="progress-bar progress-bar-warning">
                        <span class="sr-only">12% Complete</span>
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a href="index.html#">
                <span class="task">
                    <span class="desc">Backup Create Progress</span>
                    <span class="percent">54%</span>
                </span>
                
                <span class="progress progress-striped">
                    <span style="width: 54%;" class="progress-bar progress-bar-info">
                        <span class="sr-only">54% Complete</span>
                    </span>
                </span>
            </a>
        </li>
        <li>
            <a href="index.html#">
                <span class="task">
                    <span class="desc">Upgrade Progress</span>
                    <span class="percent">17%</span>
                </span>
                
                <span class="progress progress-striped">
                    <span style="width: 17%;" class="progress-bar progress-bar-important">
                        <span class="sr-only">17% Complete</span>
                    </span>
                </span>
            </a>
        </li>
    </ul>
</li>

<li class="external">
    <a href="index.html#">See all tasks</a>
</li>               </ul>
                
            </li>
        
        </ul>
    
    </div>
    
    
    <!-- Raw Links -->
    <div class="col-md-6 col-sm-4 clearfix hidden-xs">
        
        <ul class="list-inline links-list pull-right">
            
                        <li class="dropdown language-selector">
                
                Language: &nbsp;
                <a href="index.html#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
                    <img src="{{asset('assets/images/flag-uk.png')}}" />
                </a>
                
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="index.html#">
                            <img src="{{asset('assets/images/flag-de.png')}}" />
                            <span>Deutsch</span>
                        </a>
                    </li>
                    <li class="active">
                        <a href="index.html#">
                            <img src="{{asset('assets/images/flag-uk.png')}}" />
                            <span>English</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <img src="{{asset('assets/images/flag-fr.png')}}" />
                            <span>François</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <img src="{{asset('assets/images/flag-al.png')}}" />
                            <span>Shqip</span>
                        </a>
                    </li>
                    <li>
                        <a href="index.html#">
                            <img src="{{asset('assets/images/flag-es.png')}}" />
                            <span>Español</span>
                        </a>
                    </li>
                </ul>
                
            </li>
            
            <li class="sep"></li>
            
                        
            <li>
                <a href="index.html#" data-toggle="chat" data-animate="1" data-collapse-sidebar="1">
                    <i class="entypo-chat"></i>
                    Chat
                    
                    <span class="badge badge-success chat-notifications-badge is-hidden">0</span>
                </a>
            </li>
            
            <li class="sep"></li>
            
            <li>
                <a href="{{ URL::route('logout') }}">
                    {{trans('all.sign-out')}} <i class="entypo-logout right"></i>
                </a>
            </li>
        </ul>
        
    </div>
    
</div>

<hr />
  
  <ol class="breadcrumb bc-3">
    <li>
      <a href="{{asset('dashboard/main/index.html')}}"><i class="entypo-home"></i>Home</a>
    </li>
    <li>
      <a href="../icons/index.html')}}">Extra</a>
    </li>
    <li class="active">
      <strong>Comments</strong>
    </li>
  </ol>