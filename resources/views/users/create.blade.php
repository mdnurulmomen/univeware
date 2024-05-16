<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class=text-gray-900">
                    <div  class="bg-white border-b border-gray-200">
                        <div class="relative overflow-x-auto p-6">
                            <form method="POST" action="{{ route('users.store') }}">
                                @csrf

                                <!-- Prefix Name -->
                                <div>
                                    <x-input-label for="prefixname" :value="__('Prefix Name')" />

                                    <x-select-input id="prefixname" name="prefixname" :options="['mr' => 'Mr', 'mrs' => 'Mrs', 'ms' => 'Ms']" label="Prefix Name" />

                                    <x-input-error :messages="$errors->get('prefixname')" class="mt-2" />
                                </div>

                                <!-- First Name -->
                                <div class="mt-4">
                                    <x-input-label for="firstname" :value="__('First Name')" />
                                    <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname')" required autofocus autocomplete="firstname" />
                                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                </div>

                                <!-- Middle Name -->
                                <div class="mt-4">
                                    <x-input-label for="middlename" :value="__('Middle Name')" />
                                    <x-text-input id="middlename" class="block mt-1 w-full" type="text" name="middlename" :value="old('middlename')"  autofocus autocomplete="middlename" />
                                    <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                                </div>

                                <!-- Last Name -->
                                <div class="mt-4">
                                    <x-input-label for="lastname" :value="__('Last Name')" />
                                    <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')" required autofocus autocomplete="lastname" />
                                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                </div>

                                <!-- Suffix Name -->
                                <div class="mt-4">
                                    <x-input-label for="suffixname" :value="__('Suffix Name')" />
                                    <x-text-input id="suffixname" class="block mt-1 w-full" type="text" name="suffixname" :value="old('suffixname')"  autofocus autocomplete="suffixname" />
                                    <x-input-error :messages="$errors->get('suffixname')" class="mt-2" />
                                </div>

                                <!-- User Name -->
                                <div class="mt-4">
                                    <x-input-label for="username" :value="__('User Name')" />
                                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username')" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mt-4">
                                    <x-input-label for="password" :value="__('Password')" />

                                    <x-text-input id="password" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password"
                                                    required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mt-4">
                                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                    <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                    type="password"
                                                    name="password_confirmation" required autocomplete="new-password" />

                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ms-4">
                                        {{ __('Save') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
