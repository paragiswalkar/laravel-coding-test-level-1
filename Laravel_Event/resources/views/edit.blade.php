@extends('layouts.app')  
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.min.css" rel="stylesheet">
<section class="content-header">
    <div class="container-fluid" aria-label="breadcrumbs">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h2>Edit Event</h2>
            </div>
            <div class="col-sm-6">
                @if($currentUser = auth()->user())@include('layouts.breadcrumbs')@endif
            </div>
        </div>
    </div>
</section>
<div class="offset-md-3 col-md-6">
    <form id="edit_event">
        @csrf
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    <input type="text" name="name" class="form-control" placeholder="Event Name" value="{{ $event->name }}">
                    <span class="text-danger" id="nameError"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Slug:</strong>
                    <input class="form-control"  name="slug" placeholder="Slug" value="{{ $event->slug }}">
                    <span class="text-danger" id="slugError"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start At:</strong>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="startAt" name="start_at" data-target="#startAt" value="{{ date('Y/m/d H:i', strtotime($event->start_date)) }}">
                        <div class="input-group-append" data-target="#startAt" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            <input type="hidden" id="start_date" name="start_date" value="{{ date('Y/m/d H:i', strtotime($event->start_date)) }}">
                        </div>
                    </div>
                    <span class="text-danger" id="startError"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>End At:</strong>
                    <div class="input-group date" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" id="endAt" name="end_at" data-target="#endAt" value="{{ date('Y/m/d H:i', strtotime($event->end_date)) }}">
                        <div class="input-group-append" data-target="#endAT" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            <input type="hidden" id="end_date" name="end_date" value="{{ date('Y/m/d H:i', strtotime($event->end_date)) }}">
                        </div>
                    </div>
                    <span class="text-danger" id="endError"></span>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="row">
                    <div class="col-sm-6">
                        <button type="submit" class="btn-submit btn btn-primary">Submit</button>
                    </div>
                    <div class="col-sm-6">
                        <a href="{{route('dashboard')}}" class="btn btn-danger float-sm-right">Cancel</a>
                    </div>
                </div>                
            </div>
        </div>
    
    </form>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.20/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
    $('#startAt').datetimepicker({ icons: { time: 'far fa-clock' } }).on('change', function(event) {
        var firstDate = $(this).val();
        $("#start_date").val(firstDate);
    });
    
    $('#endAt').datetimepicker({ icons: { time: 'far fa-clock' } }).on('change', function(event) {
        var secondDate = $(this).val();
        $("#end_date").val(secondDate);
    });

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Authorization': 'Bearer '+ '{{$token}}'
        }
    });
   
    $(".btn-submit").click(function(e){
        e.preventDefault();
        
        var name = $("input[name=name]").val();
        var slug = $("input[name=slug]").val();
        var start_date = $("input[name=start_date]").val();
        var end_date = $("input[name=end_date]").val();
   
        $.ajax({
           type:'PUT',
           url:"/api/v1/event/edit/{{$event->id}}",
           data:{name:name, slug:slug, start_date:start_date,end_date:end_date},
           success:function(response){
            
            if(response) {
                if(response.success) {
                    window.location.href = '/admin/dashboard';
                }
            }
           },
           error: function(error) {
                const obj = JSON.parse(error.responseText);
                
                $('#nameError').text(obj.error.name);
                $('#slugError').text(obj.error.slug);
                $('#startError').text(obj.error.start_at);
                $('#endError').text(obj.error.end_at);
           }
        });
  
    });
});
</script>
@endsection