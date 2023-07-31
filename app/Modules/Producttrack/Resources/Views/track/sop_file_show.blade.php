@extends('layouts.main')

@section('title', 'Manufacture')

@section('header')
    @include('inc.header')
@endsection

@section('sidebar')
    @include('inc.sidebar')
@endsection

@section('content')
    <div class="uk-grid">
        <div class="uk-width-large-10-10">
            <div class="uk-grid uk-grid-medium" data-uk-grid-margin>
                <div class="uk-width-xLarge-10-10 uk-width-large-10-10">
                    <div class="md-card">
                        <div class="user_heading">
                            <div class="user_heading_avatar fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview fileinput-exists thumbnail"></div>
                            </div>
                            <div class="user_heading_content">
                                <h2 class="heading_b"><span class="uk-text-truncate">SOP All File Show</span></h2>
                            </div>
                        </div>
                        <div class="user_content">
                            <div class="uk-margin-top">
                                
                                    @foreach( $sop_files as $file)
                                    @php
                                    $ext = File::extension($file->sop_file);
                                    @endphp
                                    @if( $ext == 'jpg'||  $ext == 'jpeg'||  $ext == 'png' || $ext == 'JPG'||  $ext == 'JPEG'||  $ext == 'PNG')
                                    <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        <span>


                                           
                                          <b>Images:</b> &nbsp;&nbsp;&nbsp; <img src="{{ asset($file->sop_file) }}" alt="description of myimage" height="200" width="200">
                                        </span>
                                       
                                        
                                    </div>
                                   </div>
                                   @elseif( $ext == 'xlsx'|| $ext == 'xls' )
                                   <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        @php
                                        $file_name=trim($file->sop_file,"uploads/sopFiles/");
                                        @endphp
                                        <span>
                                            <b>Excel File:</b> &nbsp;&nbsp;&nbsp; <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                        </span>
                                                                               
                                    </div>
                                   </div>
                                   @elseif( $ext == 'pdf' )
                                   <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        @php
                                        $file_name=trim($file->sop_file,"uploads/sopFiles/");
                                        @endphp
                                        <span>
                                            <b>Pdf File:</b> &nbsp;&nbsp;&nbsp; <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                        </span>                                      
                                    </div>
                                   </div>
                                   @elseif( $ext == 'pptx' ||$ext == 'ppt' )
                                   <div class="uk-grid">
                                    <div class="uk-width-medium-1-1">
                                        @php
                                        $file_name=trim($file->sop_file,"uploads/sopFiles/");
                                        @endphp
                                        <span>
                                            <b>Ppt File:</b> &nbsp;&nbsp;&nbsp; <a href="{{route('track_excel_file_download',['id' => $file->id])}}"> {{$file_name}}</a> 
                                        </span>                                     
                                    </div>
                                   </div>
                                   @endif
                                @endforeach

                               
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>

            <script src="https://cdn.ckeditor.com/4.7.1/standard/ckeditor.js"></script>
            <script>
                CKEDITOR.editorConfig = function(config) {
                    config.language = 'es';
                    config.uiColor = '#F7B42C';
                    config.height = 300;
                    config.toolbarCanCollapse = true;

                };
                CKEDITOR.replace('requirements');
                // CKEDITOR.replace('editor2');
                // CKEDITOR.replace('editor3');
                // CKEDITOR.replace('editor4');
            </script>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $('#sidebar_main_account').addClass('current_section');
        $('#sidebar_track').addClass('act_item');
        $(window).load(function() {
            $("#tiktok_account").trigger('click');
        })
    </script>

   
@endsection
