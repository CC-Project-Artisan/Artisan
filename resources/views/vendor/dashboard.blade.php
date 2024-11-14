@extends('layouts.frontend')
@section('pages')

<main class="user-dashboard-main-container">
    <!-- upper section -->
    <div class="dashboard-path-wrapper">
        <!-- Breadcrumb -->
        <div class="text-sm text-customGray font-secondaryText mb-4 py-2">
            <a href="#" class="text-customBrown  hover:underline" onclick="loadPage('dashboard')">Dashboard</a>
            <span id="breadcrumb"> / Dashboard</span>
        </div>
        <!-- Sign out btn -->
        <div class="text-sm mb-4">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')" class="text-customGray hover:underline"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Sign out') }} <i class="fa-solid fa-arrow-right-from-bracket ml-1"></i>
                </x-dropdown-link>
            </form>
        </div>
    </div>

    <!-- Dashboard -->
    <div class="user-dashboard-wrapper">
        <!-- Navbar for mobile -->
        <div class="bg-customBlue text-white p-4 flex justify-between items-center lg:hidden ">
            <div class="text-lg font-bold">Dashboard</div>
            <button id="menuToggle" class="text-white focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Sidebar for desktop -->
        <div id="sidebar" class="dashboard-sidebar-desktop-wrapper">
            <ul class="dashboard-sidebar-options flex flex-col text-secondaryText">
                <li class="u-sidebar-value rounded-t-md hover:rounded-t-md" data-page="dashboard" onclick="loadPage('dashboard')">
                    <i class="fa-regular fa-address-card ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="dashboard" class="dashboard-sidebar-title">Dashboard</label><br>
                    <span class="dashboard-sidebar-sub-title">Summary of your account</span>
                </li>
                <li class="u-sidebar-value" data-page="myAdverts" onclick="loadPage('myAdverts')">
                    <i class="fa-solid fa-rectangle-ad ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">My adverts</label><br>
                    <span class="dashboard-sidebar-sub-title">Vehicles you are selling</span>
                </li>
                <li class="u-sidebar-value" data-page="myMessages" onclick="loadPage('myMessages')">
                    <i class="fa-regular fa-envelope ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">My messages</label><br>
                    <span class="dashboard-sidebar-sub-title">Send and receive messages</span>
                </li>
                <li class="u-sidebar-value" data-page="notifications" onclick="loadPage('notification')">
                    <i class="fa-regular fa-bell ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Notification</label><br>
                    <span class="dashboard-sidebar-sub-title">Receive notifications</span>
                </li>
                <li class="u-sidebar-value" data-page="savedAdverts" onclick="loadPage('savedAdverts')">
                    <i class="fa-regular fa-heart ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Saved adverts</label><br>
                    <span class="dashboard-sidebar-sub-title">Ads you have saved for later</span>
                </li>
                <li class="u-sidebar-value" data-page="myOrders" onclick="loadPage('myOrders')">
                    <i class="fa-solid fa-bag-shopping ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">My orders</label><br>
                    <span class="dashboard-sidebar-sub-title">View all your orders</span>
                </li>
                <li class="u-sidebar-value" data-page="personalDetails" onclick="loadPage('personalDetails')">
                    <i class="fa-regular fa-user ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Personal details</label><br>
                    <span class="dashboard-sidebar-sub-title">Information about you</span>
                </li>
                <li class="u-sidebar-value" data-page="accountSecurity" onclick="loadPage('accountSecurity')">
                    <i class="fa-solid fa-shield-halved ud-icon-left"></i>
                    <i class="fa-solid fa-arrow-right-long"></i>
                    <label for="myAdvert" class="dashboard-sidebar-title">Account security</label><br>
                    <span class="dashboard-sidebar-sub-title">Change your password</span>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="u-dashboard-content-wrapper">
            <!-- Dashboard page -->
            <div id="dashboard" class="ud-page-wrapper hidden">
                <div class="ud-dashboard-page">
                    <h2 class="text-[40px] font-bold text-customBrown font-mainText">Vendor! {{ ucfirst(explode(' ', Auth::user()->name)[0]) }}</h2>
                    <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                        <p class="mt-2"><i class="fa-regular fa-user mr-2"></i>{{ Auth::user()->name }}</p>
                        <p class="mt-2"><i class="fa-regular fa-envelope mr-2"></i>{{ Auth::user()->email }}</p>
                        <p class="mt-2"><i class="fa-regular fa-calendar mr-2"></i>Member since {{ Auth::user()->created_at->format('d M Y') }}</p>
                    </div>
                    <button class="ud-btn font-secondaryText" onclick="loadPage('personalDetails')">Edit my details</button>
                </div>
                <div class="ud-dashboard-page">
                    <h2 class="text-[40px] font-bold text-customBrown font-mainText">Find your favourite arts & crafts</h2>
                    <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                        <p class="mt-2">We are the fastest growing largest digital marketplace for arts and crafts in Sri Lanka.</p>
                    </div>
                    <a href="{{ route('pages.shop') }}" class="ud-btn font-secondaryText">Browse products</a>
                </div>
                <div class="ud-dashboard-page">
                    <h2 class="text-[40px] font-bold text-customBrown font-mainText">Looking to sell your arts & crafts?</h2>
                    <div class="flex gap-10 text-[#252a34] mb-4 font-secondaryText">
                        <p class="mt-2">Make more money by selling your unique products with Artisan.lk!</p>
                    </div>
                    <button class="ud-btn font-secondaryText" onclick="loadPage('selling')">Create vendor profile</button>
                </div>
            </div>

            <!-- My advert page -->
            <div id="myAdverts" class="ud-page-wrapper hidden">
                <div class="ud-advert-page">
                    <div class="ud-advert-status-wrapper flex-[25%]">
                        <p class="mt-2 mb-2"></i>Status</p>
                        <select name="" id="" class="border border-[#00000026] rounded-[5px]">
                            <option value="all">All</option>
                            <option value="live">Live</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div class="ud-advert-keyword-wrapper flex-[50%]">
                        <p class="mt-2 mb-2"></i>Keyword</p>
                        <div class="flex">
                            <input type="text" class="ud-advert-keyword-input" placeholder="Search adverts...">
                            <a href="#"><i class="ud-advert-keyword-search fa-solid fa-magnifying-glass"></i></a>
                        </div>
                    </div>
                </div>
                <div class="ud-empty-body">
                    <i class="fa-solid fa-magnifying-glass text-[#6C757D] text-[80px]"></i>
                    <h2 class="text-[#6C757D] text-[40px] font-bold">No adverts found</h2>
                    <span class="text-[#6C757D]">We couldn't find any records. Try changing search filters</span>
                    <a href="./createAds.php" class="border bg-customRed text-white px-7 py-2 rounded-[50px] hover:shadow-4xl transition-all duration-300 ease-in-out">Create a new advert</a>
                </div>
            </div>

            <div id="myMessages" class="ud-page-wrapper bg-white p-6 rounded shadow hidden">
                <h2 class="text-2xl font-bold text-blue-900">My messages</h2>
                <p class="mt-2">Your messages.</p>
            </div>

            <div id="myOrders" class="ud-page-wrapper bg-white p-6 rounded shadow hidden">
                <h2 class="text-2xl font-bold text-blue-900">My orders</h2>
                <p class="mt-2">Your orders.</p>
            </div>

            <!-- My presonal details -->
            <div id="personalDetails" class="ud-page-wrapper">
                <div class="ud-personal-page shadow-custom rounded-md p-6">
                    <div class="ud-pro-change">
                        <h2 class="text-[50px] font-bold text-customBlue">Your details</h2>
                        <span>Please keep your details up to date. Your personal data is stored securely. We do not share information with third parties.</span>

                        <form id="profileForm" action="{{ route('user-profile.update') }}" method="post" class="mt-4">
                            @csrf

                            <div class="mb-4">
                                <label for="fullName" class="block text-sm font-medium text-gray-700">Full Name</label>
                                <input type="text" name="name" id="fullName" placeholder="{{ Auth::user()->name }}" value="{{ old('name', Auth::user()->name) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email address</label>
                                <input type="email" name="email" id="email" placeholder="{{ Auth::user()->email }}" value="{{ old('email', Auth::user()->email) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div class="mb-4">
                                <label for="mobile" class="block text-sm font-medium text-gray-700">Mobile</label>
                                <input type="number" name="phone" id="mobile" placeholder="Enter your phone number" value="{{ old('phone', Auth::user()->phone) }}" min="0" oninput="this.value = Math.abs(this.value)" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>

                            <div>
                                <button type="submit" id="submitButton" class="ud-btn bg-blue-500 text-red">Save my details</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Account security page -->
            <div id="accountSecurity" class="ud-page-wrapper">
                <div class="ud-security-page">
                    <div class="ud-pw-change">
                        <h2 class="text-[50px] font-bold text-customBlue">Your password</h2>
                        <span>Please make sure to have a secure password with at least 6 characters long.</span>
                        <form action="" method="post" class="mt-4">
                            <div class="mb-4">
                                <label for="currentPassword" class="block text-sm font-medium text-gray-700">Current password</label>
                                <input type="password" name="currentPassword" id="currentPassword" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="newPassword" class="block text-sm font-medium text-gray-700">New password</label>
                                <input type="password" name="newPassword" id="newPassword" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>
                            <div class="mb-4">
                                <label for="confirmPassword" class="block text-sm font-medium text-gray-700">Confirm password</label>
                                <input type="password" name="confirmPassword" id="confirmPassword" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                            </div>
                            <button type="submit" class="ud-btn">Change password</button>
                        </form>
                    </div>
                </div>
                <!-- Delete account -->
                <div class="ud-security-page">
                    <div class="ud-dlt-acc ">
                        <h2 class="text-[50px] font-bold text-red">Delete account</h2>
                        <span>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.</span>
                    </div>
                    <button type="submit" class="ud-btn mt-3" x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">Delete my account</button>
                </div>

                <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
                    <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                        @csrf
                        @method('delete')

                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-6">
                            <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                            <x-text-input
                                id="password"
                                name="password"
                                type="password"
                                class="mt-1 block w-3/4"
                                placeholder="{{ __('Password') }}" />

                            <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
                        </div>

                        <div class="mt-6 flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">
                                {{ __('Cancel') }}
                            </x-secondary-button>

                            <x-danger-button class="ms-3">
                                {{ __('Delete Account') }}
                            </x-danger-button>
                        </div>
                    </form>
                </x-modal>
            </div>
        </div>
    </div>

    <script>
        // Load the dashboard page in mobile view
        document.getElementById('menuToggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden');
        });

        // Load the selected page
        function loadPage(page) {
            // Hide all pages
            var pages = document.querySelectorAll('.ud-page-wrapper');
            pages.forEach(function(p) {
                p.classList.add('hidden');
            });

            // Show the selected page if it exists
            var selectedPage = document.getElementById(page);
            if (selectedPage) {
                selectedPage.classList.remove('hidden');
            } else {
                console.error(`Page with id '${page}' not found.`);
                return;
            }

            // Update the active state in the sidebar
            var items = document.querySelectorAll('.u-sidebar-value');
            items.forEach(function(item) {
                item.classList.remove('bg-customBrown', 'text-white');
                var subTitle = item.querySelector('.dashboard-sidebar-sub-title');
                if (subTitle) {
                    subTitle.classList.remove('text-white');
                }
            });

            var activeItem = document.querySelector(`.u-sidebar-value[data-page="${page}"]`);
            if (activeItem) {
                activeItem.classList.add('bg-customBrown', 'text-white');
                var activeSubTitle = activeItem.querySelector('.dashboard-sidebar-sub-title');
                if (activeSubTitle) {
                    activeSubTitle.classList.add('text-white');
                }
            } else {
                console.error(`Sidebar item with data-page="${page}" not found.`);
            }

            // Update the breadcrumb
            var breadcrumb = document.getElementById('breadcrumb');
            if (breadcrumb) {
                breadcrumb.textContent = ` / ${page.charAt(0).toUpperCase() + page.slice(1).replace(/([A-Z])/g, ' $1').trim()}`;
            } else {
                console.error('Breadcrumb element not found.');
            }
        }

        // Load the default page on initial load
        document.addEventListener('DOMContentLoaded', function() {
            loadPage('dashboard');
        });


        //change the behaovier in the forms
        document.getElementById('profileForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent page refresh

            // Get the submit button
            const submitButton = document.getElementById('submitButton');

            // Prepare form data
            const formData = new FormData(this);

            // Send AJAX request
            fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the displayed name and email in the dashboard
                        document.querySelector('.ud-dashboard-page h2').innerText = `Hello! ${data.user.name.split(' ')[0]}`;
                        document.querySelector('.ud-dashboard-page .fa-user').nextSibling.textContent = data.user.name;
                        document.querySelector('.ud-dashboard-page .fa-envelope').nextSibling.textContent = data.user.email;
                        document.querySelector('.ud-dashboard-page .fa-calendar').nextSibling.textContent = `Member since ${data.user.created_at}`;

                        // Update button to show success
                        submitButton.innerText = 'Saved!';
                        submitButton.classList.remove('bg-blue-500');
                        submitButton.classList.add('bg-green-500');
                    } else {
                        alert('Error updating profile. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while updating your profile.');
                });
        });

        // Switch between tabs in selling section
        function openTab(event, tabName) {
            // Get all tab links and tab content elements
            const tabLinks = document.querySelectorAll('.tab-link');
            const tabContents = document.querySelectorAll('.tab-content');

            // Remove the active class from all tabs and tab contents
            tabLinks.forEach(link => link.classList.remove('active'));
            tabContents.forEach(content => content.classList.remove('active'));

            // Add the active class to the clicked tab and the corresponding tab content
            event.currentTarget.classList.add('active');
            document.getElementById(tabName).classList.add('active');
        }
    </script>
</main>

@endsection