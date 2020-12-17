
<div>
    @if(session()->has('message'))
        <div class='alert alert-success'>{{ session('message') }}</div>
    @endif
    <div class="ml-3 mt-3">
    
        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" wire:click="create">
          <span>Create</span>
        </button>
      
    </div>
    <x-jet-dialog-modal wire:model="modalVisible">
        <x-slot name="title">
        {{ __('Users Management') }}
        </x-slot>

        

        <x-slot name="content">
            <div class="row">
                <div class="col-md-6">
                    <x-jet-label for="name" value="{{ __('Name') }}" />
                    <x-jet-input autocomplete="off" id="name" class="block mt-1 w-full" type="text" wire:model="userData.name"/>
                    @error('userData.name')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="col-md-6">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input autocomplete="off" id="email" class="block mt-1 w-full" type="email" wire:model="userData.email"/>
                    @error('userData.email')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <select class="custom-select" wire:model="userData.type">
                        @foreach(App\Models\Role::all() as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    @error('userData.type')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-md-6">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input autocomplete="off" id="password" class="block mt-1 w-full" type="password" wire:model="userData.password"/>
                </div>
            </div> --}}

        </x-slot>

        <x-slot name="footer">

        <x-jet-secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
            {{ __('Hủy') }}
        </x-jet-secondary-button>
        
        @if(!$userId)
        <x-jet-button wire:click.prevent="store">
            Save
        </x-jet-button>
        @else
        <x-jet-button wire:click.prevent="update">
            Update
        </x-jet-button>
        @endif
        </x-slot>
    </x-jet-dialog-modal>
<p></p>
    <!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Name
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Email
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Role
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    View
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Edit
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Delete
                </th>
                
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
            @foreach($users as $user)
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">
                    {{ $user->name }}
                    </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ $user->email }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                    {{ App\Models\Role::find($user->type)->name}}
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm ">
                    <a href="#" class="text-purple-600 hover:opacity-50 ">
                        <svg class="w-6 h-6 text-center" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>                  
                  </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                  <a href="#" class="text-indigo-600 hover:opacity-50" wire:click="show({{ $user->id }})">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>      
                </a>                  
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                    <a href="#" class="text-red-600 hover:opacity-50" wire:click="delete({{ $user->id }})">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>    
                    </a>                  
                  </td>
              </tr>
              @endforeach
  
              <!-- More rows... -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>


