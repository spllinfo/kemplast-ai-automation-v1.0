@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center justify-content-between page-header-breadcrumb flex-wrap gap-2">
        <div>
            <nav>
                <ol class="breadcrumb mb-1">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Settings</a></li>
                    <li class="breadcrumb-item active">Website</li>
                </ol>
            </nav>
            <h1 class="page-title fw-medium fs-18 mb-0">Web Settings</h1>
        </div>
        <div class="d-flex">
            <button type="button" class="btn btn-icon btn-sm btn-light me-1"><i class="ri-filter-3-fill"></i></button>
            <button type="button" class="btn btn-primary btn-sm"><i class="ri-share-line me-1 align-middle"></i>Share</button>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('settings.website.update') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-xl-3">
                <div class="card custom-card">
                    <div class="card-body">
                        <ul class="nav nav-tabs flex-column nav-tabs-header mail-settings-tab mb-0" role="tablist">
                            <li class="nav-item me-0">
                                <a class="nav-link active" data-bs-toggle="tab" role="tab" href="#email-settings" aria-selected="true">
                                    <i class="ri-mail-line fs-14 lh-1 text-primary me-2 align-middle"></i>
                                    Email
                                </a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" href="#security-settings" aria-selected="false">
                                    <i class="ri-shield-line fs-14 lh-1 text-primary me-2 align-middle"></i>
                                    Security
                                </a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" href="#notifications-settings" aria-selected="false">
                                    <i class="ri-notification-line fs-14 lh-1 text-primary me-2 align-middle"></i>
                                    Notifications
                                </a>
                            </li>
                            <li class="nav-item me-0">
                                <a class="nav-link" data-bs-toggle="tab" role="tab" href="#account-settings" aria-selected="false">
                                    <i class="ri-user-settings-line fs-14 lh-1 text-primary me-2 align-middle"></i>
                                    Account Settings
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card custom-card mt-4">
                    <div class="card-header">
                        <div class="card-title">Social Links</div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Facebook :</label>
                            <input type="url" class="form-control" name="social[facebook]" value="{{ $settings['website']['social']['facebook'] ?? 'https://' }}" placeholder="https://">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Twitter :</label>
                            <input type="url" class="form-control" name="social[twitter]" value="{{ $settings['website']['social']['twitter'] ?? 'https://' }}" placeholder="https://">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pinterest:</label>
                            <input type="url" class="form-control" name="social[pinterest]" value="{{ $settings['website']['social']['pinterest'] ?? 'https://' }}" placeholder="https://">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Linkedin :</label>
                            <input type="url" class="form-control" name="social[linkedin]" value="{{ $settings['website']['social']['linkedin'] ?? 'https://' }}" placeholder="https://">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-9">
                <div class="tab-content">
                    <!-- Security Settings Tab -->
                    <div class="tab-pane fade show active" id="security-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Logging In</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Security settings related to logging into your account and taking down account if any mischevious action happened.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectionmb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Push Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectionmb-4">Push notifications are received in real time while you are online. You can customize them below.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Updates</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Real-time updates on stock levels and critical shortages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="push_stock_updates" {{ ($settings['notifications']['push_stock_updates'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plan Updates</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Instant alerts on changes to dispatch plans or delivery schedules.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="push_dispatch_updates" {{ ($settings['notifications']['push_dispatch_updates'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Overdue Payments</h6>
                                        <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-0">Real-time notifications for overdue payments or credit alerts.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="push_overdue_payments" {{ ($settings['notifications']['push_overdue_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security Settings Tab -->
                    <div class="tab-pane fade" id="security-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Logging In</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectionmb-4">Security settings related to logging into your account and taking down account if any mischevious action happened.</p>

                                <div class="mb-4">
                                    <h6 class="mb-2">Max Limit for login attempts</h6>
                                    <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-3">Account will freeze for 24hrs while attempt to login with wrong credentials for selected of times</p>
                                    <select class="form-select w-auto" name="max_login_attempts">
                                        <option value="3" {{ ($settings['security']['max_login_attempts'] ?? '3') == '3' ? 'selected' : '' }}>3 Attempts</option>
                                        <option value="5" {{ ($settings['security']['max_login_attempts'] ?? '3') == '5' ? 'selected' : '' }}>5 Attempts</option>
                                        <option value="10" {{ ($settings['security']['max_login_attempts'] ?? '3') == '10' ? 'selected' : '' }}>10 Attempts</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Account Freeze time management</h6>
                                    <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsectiontext-muted mb-3">You can change the time for the account freeze when attempts for</p>
                                    <select class="form-select w-auto" name="account_freeze_time_format">
                                        <option value="1 Day" {{ ($settings['security']['account_freeze_time_format'] ?? '1 Day') == '1 Day' ? 'selected' : '' }}>1 Day</option>
                                        <option value="12 Hours" {{ ($settings['security']['account_freeze_time_format'] ?? '1 Day') == '12 Hours' ? 'selected' : '' }}>12 Hours</option>
                                        <option value="6 Hours" {{ ($settings['security']['account_freeze_time_format'] ?? '1 Day') == '6 Hours' ? 'selected' : '' }}>6 Hours</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Password Requirements</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Security settings related to password strength.</p>

                                <div class="mb-3">
                                    <h6 class="mb-2">Minimum number of characters in the password</h6>
                                    <p class="text-muted mb-3">There should be a minimum number of characters for a password to be validated that should be set here.</p>
                                    <input type="number" class="form-control w-auto" name="min_password_length" value="{{ $settings['security']['min_password_length'] ?? '8' }}">
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Number</h6>
                                        <p class="text-muted mb-0">Password should contain a number.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_number" {{ ($settings['security']['password_require_number'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Contain A Special Character</h6>
                                        <p class="text-muted mb-0">Password should contain a special Character.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_special" {{ ($settings['security']['password_require_special'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Atleast One Capital Letter</h6>
                                        <p class="text-muted mb-0">Password should contain atleast one capital letter.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="password_require_capital" {{ ($settings['security']['password_require_capital'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <h6 class="mb-2">Maximum Password Length</h6>
                                    <p class="text-muted mb-3">Maximum password lenth should be selected here.</p>
                                    <input type="number" class="form-control w-auto" name="max_password_length" value="{{ $settings['security']['max_password_length'] ?? '32' }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Notifications Settings Tab -->
                    <div class="tab-pane fade" id="notifications-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Email Notifications</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Email notifications are sent when you are offline. You can customize them by enabling or disabling specific categories.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Production Stock Alerts</h6>
                                        <p class="text-muted mb-0">Get notified about low stock levels or replenishment requirements.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_stock_alerts" {{ ($settings['notifications']['email_stock_alerts'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dispatch Plans</h6>
                                        <p class="text-muted mb-0">Stay updated on dispatch schedules and changes to delivery plans.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dispatch_plans" {{ ($settings['notifications']['email_dispatch_plans'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Dues & Payments</h6>
                                        <p class="text-muted mb-0">Receive reminders about payment deadlines and overdue invoices.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_dues_payments" {{ ($settings['notifications']['email_dues_payments'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Pending Orders</h6>
                                        <p class="text-muted mb-0">Alerts for incomplete or pending orders requiring attention.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_pending_orders" {{ ($settings['notifications']['email_pending_orders'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">System Announcements</h6>
                                        <p class="text-muted mb-0">Updates on critical system announcements or operational messages.</p>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="email_system_announcements" {{ ($settings['notifications']['email_system_announcements'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Account Settings Tab -->
                    <div class="tab-pane fade" id="account-settings" role="tabpanel">
                        <div class="card custom-card">
                            <div class="card-header">
                                <div class="card-title">Two Step Verification</div>
                            </div>
                            <div class="card-body">
                                <p class="mb-4">Two-step verification provides enhanced security measures and helps prevent unauthorized access and fraudulent activities.</p>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <h6 class="mb-1">Two Step Verification</h6>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="two_step_verification" {{ ($settings['security']['two_step_verification'] ?? 'off') == 'on' ? 'checked' : '' }}>
                                        <span class="form-check-label">OFF</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Authentication</h6>
                                    <div class="d-flex gap-3 mt-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="password" {{ ($settings['security']['authentication_method'] ?? 'password') == 'password' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-lock-password-line me-2"></i> Password
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="authentication_method" value="fingerprint" {{ ($settings['security']['authentication_method'] ?? 'password') == 'fingerprint' ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                <i class="ri-fingerprint-line me-2"></i> Finger Print
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Recovery Mail</h6>
                                    <p class="text-muted mb-3">In case of forgetting passwords, emails are sent to <span class="text-primary">aana14@gmail.com</span>.</p>
                                </div>

                                <div class="mb-4">
                                    <h6 class="mb-2">Reset Password</h6>
                                    <p class="text-muted mb-3">Password should be min of <span class="text-success">8 digits</span>, atleast <span class="text-success">One Capital letter</span> and <span class="text-success">One Special Character</span> included.</p>

                                    <div class="mb-3">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password" placeholder="Current Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password" placeholder="New Password">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card custom-card mt-4">
                            <div class="card-header">
                                <div class="card-title">Registered Devices</div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-smartphone-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Mobile-LG-1023</h6>
                                            <p class="text-muted mb-0">India, In-Feb 30, 04:45PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">LeFebo-1291203</h6>
                                            <p class="text-muted mb-0">India, In-Aug 12, 12:25PM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-macbook-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Macbook-Suzika</h6>
                                            <p class="text-muted mb-0">India, In-Jul 18, 8:34AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="ri-computer-line fs-24"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-1">Apple-Desktop</h6>
                                            <p class="text-muted mb-0">India, In-Jan 14, 11:14AM</p>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-icon btn-sm btn-light"><i class="ri-more-2-fill"></i></button>
                                    </div>
                                </div>

                                <div class="mt-4 text-end">
                                    <button type="button" class="btn btn-primary">Signout from all devices</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-end">
                <button type="button" class="btn btn-secondary me-2">Restore Defaults</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
@endsection
