<section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar" style+"position:absolute;">
            <!-- User Info -->
            <div class="user-info">
                <div class="image">
                    <img src="{{ Avatar::create(substr(Auth::user()->name,0, 1))->setBorder(1, '#aabbcc')->toBase64() }}" width="48" height="48" alt="User" />
                </div>
                <div class="info-container">
                    <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                    <div class="email">{{ Auth::user()->email }}</div>
                    <div class="btn-group user-helper-dropdown">
                        <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                        <ul class="dropdown-menu pull-right" style="">
                            <li><a href="{{ route('users.editprofile', Auth::user()->id) }}"><i class="material-icons">person</i>Profile</a></li>
                            <li role="seperator" class="divider"></li>
                            <li>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    <i class="material-icons">input</i>
                                    Sign Out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- #User Info -->
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>
                    <li {{Route::is('users.dashboard')? 'class=active':''}}>
                        <a href="{{route('users.dashboard')}}">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">business</i>
                            <span>Companies</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ route('companies.create') }}">
                                    <span>Add Company</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('companies.index') }}">
                                    <span>Show Companies</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                     <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">group</i>
                            <span>Users</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ route('users.create') }}">
                                    <span>Add User</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('users.index') }}">
                                    <span>Show Users</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">insert_drive_file</i>
                            <span>Invoices</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{route('invoices.create')}}">
                                    <span>Add Invoice</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('invoices.index')}}">
                                    <span>Invoices</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('invoices.form_without')}}">
                                    <span>Invoices w/o Form</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">content_copy</i>
                            <span>Form Design</span>
                        </a>
                        <ul class="ml-menu">
                            <li>
                                <a href="{{ route('dragdrop.invoiceslist') }}">
                                    <span>Create Form Design</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('dragdrop.index') }}">
                                    <span>List of Form Design</span>
                                </a>
                            </li>
                        </ul>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="menu-toggle">
                                <i class="material-icons">assignment_ind</i>
                                <span>Data Entry</span>
                            </a>
                            <ul class="ml-menu">
                                <li>
                                    <a href="{{ route('parse.list') }}">
                                        <span>List of Data Entries</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('parse.result') }}">
                                        <span>Invoice Details</span>
                                    </a>
                                </li>
                            </ul>
                        </li>

                </ul>
            </div>
            <!-- #Menu -->
            
            <!-- Footer -->
            <div class="legal">
                <div class="copyright">
                    &copy; 2018 <a href="javascript:void(0);">Revelo Solutions, Inc.</a>
                </div>
                <div class="version">
                    <b>Pre-Alpha Version: </b> 0.0.11
                    <a href="{{ route('about.index')}}">
                        <p>References</p>
                    </a>
                </div>
            </div>
            <!-- #Footer -->
        </aside>
        <!-- #END# Left Sidebar -->
        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs tab-nav-right" role="tablist">
                <li role="presentation" class="active"><a href="#settings" data-toggle="tab">SETTINGS</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active in active" id="settings">
                    <div class="demo-settings">
                        <p>GENERAL SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Report Panel Usage</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Email Redirect</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>SYSTEM SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Notifications</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Auto Updates</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                        <p>ACCOUNT SETTINGS</p>
                        <ul class="setting-list">
                            <li>
                                <span>Offline</span>
                                <div class="switch">
                                    <label><input type="checkbox"><span class="lever"></span></label>
                                </div>
                            </li>
                            <li>
                                <span>Location Permission</span>
                                <div class="switch">
                                    <label><input type="checkbox" checked><span class="lever"></span></label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
        <!-- #END# Right Sidebar -->
    </section>