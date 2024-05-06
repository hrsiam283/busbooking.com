@extends('mainlayout')

@section('content')
    <div class="container mt-5">
        @php
            $view = $bus->view;
        @endphp


        <h2>{{ $view }}</h2>
        <form action="{{ route('seat_management') }} " method="GET">
            <input type="hidden" name="id" value="{{ $bus->id }}">
            <div class="form-group row">
                <div class="col-md-1">
                    <input type="checkbox" id="0" name="A1" value="1" class="form-check-input">
                    <label for="A1" class="form-check-label">A1</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="1" name="A2" value="1" class="form-check-input">
                    <label for="A2" class="form-check-label">A2</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="2" name="A3" value="1" class="form-check-input">
                    <label for="A3" class="form-check-label">A3</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="3" name="A4" value="1" class="form-check-input">
                    <label for="A4" class="form-check-label">A4</label>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-md-1">
                    <input type="checkbox" id="4" name="B1" value="1" class="form-check-input">
                    <label for="B1" class="form-check-label">B1</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="5" name="B2" value="1" class="form-check-input">
                    <label for="B2" class="form-check-label">B2</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="6" name="B3" value="1" class="form-check-input">
                    <label for="B3" class="form-check-label">B3</label>
                </div>
                <div class="col-md-1">
                    <input type="checkbox" id="7" name="B4" value="1" class="form-check-input">
                    <label for="B4" class="form-check-label">B4</label>
                </div>
            </div>
            <!-- Repeat the above code for other rows -->
            <!-- Example: -->


    </div>
    <!-- Repeat the above code for other rows -->
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
    </div>
    @for ($i = 0; $i < 8; $i++)
        @if ($view[$i])
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
