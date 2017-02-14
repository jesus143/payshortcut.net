

<table id="example" class="display" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>telephone</th>
        <th>country</th>
        <th>Details</th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <th>id</th>
        <th>name</th>
        <th>email</th>
        <th>telephone</th>
        <th>country</th>
        <th>Details</th>
    </tr>
    </tfoot>
    <tbody>
        @foreach ($members as $member)
            <tr>
                <td> {{$member->id}} </td>
                <td> {{$member->first_name . ' ' . $member->last_name}} </td>
                <td> {{$member->email}} </td>
                <td> {{$member->telephone}} </td>
                <td> {{$member->country}} </td>
                <td> <a href="{{route('member.show', $member->id)}}"> Details </td>
            </tr>
        @endforeach
    </tbody>
</table>