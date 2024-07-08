
<style>
table, th, td {
  border: 1px solid black;
}
</style>
    <h3>New Ticket created!</h3>
    <p>The Ticket is created by {{ ucfirst(Auth::user()->name) }}!</p>
<table style="width:100%">
        <tr>
            <th scope="col">Subject</th>
            <td>{{ $ticket->subject->name }}</td>
        </tr>
        <tr>
            <th scope="col">Description</th>
            <td>{!! $ticket->description !!}</td>
        </tr>
        <tr>
            <th scope="col">Status</th>
            <td>{{ $ticket->ticket_status == 1 ? 'Open' : ($ticket->ticket_status == 2 ? 'Process' : 'Close') }}</td>
        </tr>
</table>
