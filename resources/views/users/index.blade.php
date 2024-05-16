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

                    @if(session()->has('message'))
                        <div class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                              <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                              <span class="font-medium">Success alert!</span> {{ session()->get('message') }}.
                            </div>
                        </div>
                    @endif

                    <div  class="bg-white border-b border-gray-200">
                        <div  class="p-6 mb-6 flex justify-between">
                            <p class="font-bold">{{ __("Users List") }}</p>

                            <x-hyperlink-blue-button href="{{ route('users.create') }}">
                                {{ __('New User') }}
                            </x-hyperlink-blue-button>
                        </div>

                        <div class="relative overflow-x-auto">
                            <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr class="grid grid-cols-3">
                                        <th scope="col" class="px-6 py-3">
                                            #
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Username
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Actions
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $key => $user)
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 grid grid-cols-3">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{ $key+1 }}
                                            </th>
                                            <td class="px-6 py-4 capitalize">
                                                {{ $user->username }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <x-hyperlink-lime-button href="{{ route('users.edit', $user->id) }}">
                                                    {{ __('Edit') }}
                                                </x-hyperlink-lime-button>

                                                <form  action="{{ route('users.destroy', $user->id) }}"  method="POST"  onsubmit="return confirm('{{ trans('Are You Sure ? ') }}');"  style="display: inline-block;">
                                                    <input  type="hidden"  name="_method"  value="DELETE">
                                                    <input  type="hidden"  name="_token"  value="{{ csrf_token() }}">
                                                    <input  type="submit"  class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 ml-1" value="Delete">
                                                </form>
                                            </td>
                                        </tr>

                                        @empty
                                        <tr>
                                            <td class="col-span-3 text-red-600 text-center p-4">No User Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
