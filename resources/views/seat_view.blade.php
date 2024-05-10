@extends('mainlayout')

@section('content')
    <div class="container mt-5">
        @php
            $view = $bus->view;
        @endphp


        <h2>{{ $view }}</h2>
        <h2>Seats Available: {{ $bus->seats_available }}</h2>
        <form action="{{ route('seat_management') }} " method="GET">
            <input type="hidden" name="id" value="{{ $bus->id }}">
            <div class="form-group row">
                <table>
                    @php
                        $index = 0;
                        $rows = range('A', 'J');
                        $columns = range(1, 4); // Column labels
                    @endphp

                    @foreach ($rows as $row)
                        <tr>
                            @foreach ($columns as $column)
                                @php
                                    $name = $row . $column; // Generate name attribute
                                @endphp
                                <td>
                                    <input type="checkbox" id="{{ $index }}" name="{{ $name }}" value="1"
                                        class="form-check-input">
                                    <label for="{{ $name }}" class="form-check-label">{{ $name }}</label>
                                </td>
                                @php
                                    $index = $index + 1;
                                @endphp
                            @endforeach
                        </tr>
                    @endforeach
                </table>
            </div>


            <!-- Repeat the above code for other rows -->
            <!-- Example: -->


            <!-- Repeat the above code for other rows -->
            <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>
    @for ($i = 0; $i < strlen($view); $i++)
        @if ($view[$i] == '1')
            <script>
                var checkbox = document.getElementById('{{ $i }}');
                checkbox.disabled = true;
            </script>
        @endif
    @endfor
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    if (this.checked) {
                        this.value = "1"; // Set value to "1" if checked
                    } else {
                        this.value = "2"; // Set value to "2" if unchecked
                    }
                });
            });
        });
    </script>
@endsection
