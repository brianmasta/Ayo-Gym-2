<main>
    <title>Ayo Gym Dashboard - Sign In page</title>
    <!-- Section -->
    <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
        <div class="container">
            {{-- <p class="text-center"><a href="{{ route('dashboard') }}" class="text-gray-700"><i
                class="fas fa-angle-left me-2"></i> Back to homepage</a></p> --}}
            <div wire:ignore.self class="row justify-content-center form-bg-image"
                data-background-lg="/assets/img/illustrations/signin.svg">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="bg-white shadow-soft border rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                        <div class="text-center text-md-center mb-4 mt-md-0">
                            <div class="col-auto">
                                <!-- Avatar -->
                                <img alt="Image placeholder" src="/assets/img/favicon/logo-only.png" class=" rounded" style="width: 180px;">
                            </div>
                            <h4 class="mb-3 h3" style="color: rgb(98, 98, 98);">AYO GYM</h4>
                            {{-- <p class="mb-0"> Create new account or
                                <p class="mb-0">Sign in with these credentials:</p>
                                <p class="mb-0"> Email: <strong>admin@volt.com</strong> Password:
                                    <strong>secret</strong></p>

                            </p> --}}
                        </div>
                        <form wire:submit="login" action="#" class="mt-4" method="POST">
                            @csrf  
                            {{-- @method('POST') --}}
                            <!-- Form -->
                            <div class="form-group mb-4">
                                <label for="email">Your Email</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1"><svg
                                            class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z">
                                            </path>
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                        </svg></span>
                                    <input wire:model.live="email" type="email" class="form-control"
                                        placeholder="admin@ag.com" id="email" autofocus required>
                                </div>
                                @error('email') <div wire:key="form" class="invalid-feedback"> {{$message}} </div>
                                @enderror
                            </div>
                            <!-- End of Form -->
                            <div class="form-group">
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="password">Your Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2"><svg
                                                class="icon icon-xs text-gray-600" fill="currentColor"
                                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd"
                                                    d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                    clip-rule="evenodd"></path>
                                            </svg></span>
                                        <input wire:model.blur="password" type="password" placeholder="Password"
                                            class="form-control" id="password" required>
                                    </div>
                                    @error('password') <div class="invalid-feedback"> {{ $message }} </div> @enderror
                                </div>
                                <!-- End of Form -->
                                <div class="d-flex justify-content-between align-items-top mb-4">
                                    <div class="form-check">
                                        <input wire:model.live="remember_me" class="form-check-input" type="checkbox"
                                            value="" id="remember">
                                        <label class="form-check-label mb-0" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <div><a href="{{ route('forgot-password') }}" class="small text-right">Lost
                                            password?</a></div>
                                </div>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary" wire:wire:navigate >Sign in</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>