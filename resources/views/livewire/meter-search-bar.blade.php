

<div class="relative ">
    <input 
    wire:model="query"
    type="text" 
    placeholder="Search By Meter Name And Number" 
    class="form-control mt-0"
    wire:keydown.tab="resetData"
    wire:keydown.escape="resetData"
    >
    {{-- <select name="" id="" wire:model="query">
        <option value="">Search Meters..</option>
        @foreach ($data as $item)
        <option value="{{$item->name}}">{{$item->name}}</option>
        @endforeach
       
    </select> --}}

@if (!empty($query))

@if (!empty($meters))


<div style="margin-left: 12px" class="container-fluid absolute list-group rounded-t-none">
    <div class="row">
        <div class="white-box">
            @foreach ($meters as $meter)
            <table class="table">
                <tr>
                    <th style="width: 50px;text-align:center;">ID</th>
                    <th style="width: 50px;text-align:center;">Name</th>
                    <th style="width: 50px;text-align:center;">Meter Number</th>
                    <th style="width: 200px;text-align:center;">User Id</th>
                    <th style="width: 200px;text-align:center;">User Name</th>
                    <th style="width: 50px;text-align:center;">Unit/mnth</th>
                    <th style="width: 50px;text-align:center;">Price</th>
                    <th style="width: 50px;text-align:center;">Status</th>
                    <th colspan="3">Actions</th>
                </tr>

              

                <tr>
                    <td style="width: 50px;text-align:center;">{{ $meter['id'] }}</td>
                    <td style="width: 50px;text-align:center;">{{ $meter['name'] }}</td>
                    <td style="width: 50px;text-align:center;">{{ $meter['meter_number'] }}</td>
                    <td style="width: 50px;text-align:center;">
                        @if ($meter['user_id'] == null)
                            Not assigned to any user
                        @else
                            {{ $meter['user_id'] }}
                        @endif
                    </td>
                    <td style="width: 50px;text-align:center;">
                        @if ($meter['user_id'] == null)
                            Not assigned to any user
                        @else
                            {{ $meter['user_name'] }}
                        @endif
                    </td>
                    <td style="width: 50px;text-align:center;">{{ $meter['unit'] }}</td>
                    <td style="width: 50px;text-align:center;">{{ $meter['price'] }}</td>
                    @if ($meter['status'] == 'available')
                        <td style="width: 50px;text-align:center;color:green">{{ $meter['status'] }}</td>
                    @elseif($meter['status'] = 'Booked')
                        <td style="width: 50px;text-align:center; color:red">{{ $meter['status'] }}</td>
                    @endif
                    <td style="width: 50px;text-align:center;">
                        <form action="/admin/meter/{{ $meter['id'] }}/edit" method="GET"> <input
                                class="btn btn-success" type="submit" value="Update"></form>
                    </td>
                    @if ($meter['status'] == 'Booked')
                        <td><input class="btn btn-danger" type="submit" value="Delete" disabled
                                title="Booked meter cannot be deleted"></td>
                    @elseif($meter['status'] == 'available')
                        <form method="POST" action="/admin/meter/{{ $meter['id'] }}">
                            @csrf
                            @method('delete')
                            <td><input class="btn btn-danger" type="submit" value="Delete"></td>
                        </form>
                    @endif
                </tr>


            </table>
        </div>
    </div>
</div>
@endforeach

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
