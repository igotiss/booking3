@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">



        <stays-grid></stays-grid>


    </div>
</div>
@endsection
<script>
    import StaysGrid from "../js/components/StaysGrid";
    export default {
        components: {StaysGrid}
    }
</script>
