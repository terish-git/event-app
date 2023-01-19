
            @foreach ($events as $event)
                <tr>
                    <td>{{ ++$loop->index }}</td>
                    <td>{{ $event->name }}</td>
                    <td>{{ $event->owner->first_name }}</td>
                    <td>{{ $event->start_date->format('d M Y') }}</td>
                    <td>{{ $event->end_date->format('d M Y') }}</td>
                </tr>
            @endforeach

            <tr>
       <td colspan="5" align="center">
       {{ $events->links() }}
       </td>
      </tr>
