
    <div class="relative ">
        <input 
        wire:model="query"
        type="text" 
        placeholder="Search By User Name, Email And Number" 
        class="form-control mt-0"
        wire:keydown.tab="resetData"
        wire:keydown.escape="resetData"
        style="width:700px"
        >
        {{-- <select name="" id="" wire:model="query">
            <option value="">Search Meters..</option>
            @foreach ($data as $item)
            <option value="{{$item->name}}">{{$item->name}}</option>
            @endforeach
           
        </select> --}}
    
        <div wire:loading class="absolute z-10 list-group" style="width:700px">
            <ul class="bg-white">
                <li style="padding: 10px; list-style-type: none;">
                Searching...
                </li>
            </ul>
            </div>


    @if (!empty($query))
   
    @if (!empty($users))
    
    @foreach ($users as $user)
    <div style="margin-left: -12px" class="container-fluid rounded-t-none absolute">
        
            <div class="row">
                <div  class="white-box">
                <table class="table">
                    <tr>
                        <th style="width: 50px;text-align:center;">ID</th>
                        <th style="width: 50px;text-align:center;">Name</th>
                        <th style="width: 50px;text-align:center;">Email</th>
                        <th style="width: 200px;text-align:center;">Verification</th>
                        <th style="width: 200px;text-align:center;">Role</th>
                        <th colspan="1" class="border-top-0">Actions</th>
                    </tr>
    
                    
                    <tr>
                        <td style="width: 50px;text-align:center;">{{ $user['id'] }}</td>
                        <td style="width: 50px;text-align:center;">{{ $user['name'] }}</td>
                        <td style="width: 50px;text-align:center;">{{ $user['email'] }}</td>
                        <td style="width: 50px;text-align:center;">{{ $user['verified'] }}</td>
                        <td style="width: 50px;text-align:center;">{{ $user['role'] }}</td>
                        <td style="width: 45px;"><a href="/admin/userstable/{{Hash::Make($user['id'])}}/edit"><button class="btn btn-success">Update</button></a></td>
                        <form method="POST" action="/admin/userstable/{{$user['id']}}">
                            @csrf
                            @method('delete')
                            <td><input class="btn btn-danger" type="submit" value="Delete"></td>
                            </form>
                    </tr>
                    @endforeach
    
                </table>
            </div>
        </div>
    </div>
 
    
    @else
    <div class="absolute z-10 list-group">
    <ul class="bg-white">
        <li style="padding: 10px; list-style-type: none;">
        No Results!!!
        </li>
    </ul>
    </div>
 @endif
    @endif 
    </div>
    

