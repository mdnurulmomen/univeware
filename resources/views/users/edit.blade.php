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
                            <form method="POST" action="{{ route('users.update', $user->id) }}">
                                @method('PUT')
                                @csrf

                                <!-- Prefix Name -->
                                <div>
                                    <x-input-label for="prefixname" :value="__('Prefix Name')" />

                                    <x-select-input id="prefixname" name="prefixname" :selected="$user->prefixname" :options="['mr' => 'Mr', 'mrs' => 'Mrs', 'ms' => 'Ms']" label="Prefix Name" />

                                    <x-input-error :messages="$errors->get('prefixname')" class="mt-2" />
                                </div>

                                <!-- First Name -->
                                <div class="mt-4">
                                    <x-input-label for="firstname" :value="__('First Name')" />
                                    <x-text-input id="firstname" class="block mt-1 w-full" type="text" name="firstname" :value="old('firstname', $user->firstname)" required autofocus autocomplete="firstname" />
                                    <x-input-error :messages="$errors->get('firstname')" class="mt-2" />
                                </div>

                                <!-- Middle Name -->
                                <div class="mt-4">
                                    <x-input-label for="middlename" :value="__('Middle Name')" />
                                    <x-text-input id="middlename" class="block mt-1 w-full" type="text" name="middlename" :value="old('middlename', $user->middlename)"  autofocus autocomplete="middlename" />
                                    <x-input-error :messages="$errors->get('middlename')" class="mt-2" />
                                </div>

                                <!-- Last Name -->
                                <div class="mt-4">
                                    <x-input-label for="lastname" :value="__('Last Name')" />
                                    <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname', $user->lastname)" required autofocus autocomplete="lastname" />
                                    <x-input-error :messages="$errors->get('lastname')" class="mt-2" />
                                </div>

                                <!-- Suffix Name -->
                                <div class="mt-4">
                                    <x-input-label for="suffixname" :value="__('Suffix Name')" />
                                    <x-text-input id="suffixname" class="block mt-1 w-full" type="text" name="suffixname" :value="old('suffixname', $user->suffixname)"  autofocus autocomplete="suffixname" />
                                    <x-input-error :messages="$errors->get('suffixname')" class="mt-2" />
                                </div>

                                <!-- User Name -->
                                <div class="mt-4">
                                    <x-input-label for="username" :value="__('User Name')" />
                                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username" :value="old('username', $user->username)" required autofocus autocomplete="username" />
                                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mt-4">
                                    <x-input-label for="email" :value="__('Email')" />
                                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="email" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button class="ms-4">
                                        {{ __('Update') }}
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
