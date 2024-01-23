                 <div class="form-group">
                    {!! Form::label('meta_title', 'meta_title:') !!}
                    {{ Form::input('text', 'meta_title', @$value->meta_title, ['class' => 'form-control','required'=>'required']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_keywords', 'meta_keywords:') !!}
                    {{ Form::input('text', 'meta_keywords',  @$value->meta_keywords, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('meta_description', 'meta_description:') !!}
                    {{ Form::input('text', 'meta_description',  @$value->meta_description, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('og_title', 'og_title:') !!}
                    {{ Form::input('text', 'og_title',  @$value->og_title, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {!! Form::label('og_description', 'og_description:') !!}
                    {{ Form::input('text', 'og_description',  @$value->og_description, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('og_keywords', 'og_keywords:') !!}
                    {{ Form::input('text', 'og_keywords',  @$value->og_keywords, ['class' => 'form-control']) }}
                </div>

                 <div class="form-group">
                    {!! Form::label('og_image', 'og_image:') !!}
                    {{ Form::input('text', 'og_image',  @$value->og_image, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('og_video', 'og_video:') !!}
                    {{ Form::input('text', 'og_video',  @$value->og_video, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('meta_region', 'meta_region:') !!}
                    {{ Form::input('text', 'meta_region',  @$value->meta_region, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('meta_position', 'meta_position:') !!}
                    {{ Form::input('text', 'meta_position',  @$value->meta_position, ['class' => 'form-control']) }}
                </div>
                 <div class="form-group">
                    {!! Form::label('meta_icbm', 'meta_icbm:') !!}
                    {{ Form::input('text', 'meta_icbm',  @$value->meta_icbm, ['class' => 'form-control']) }}
                </div>               
                                     
                <div class="well well-sm">
                    <button type="submit" class="btn btn-sm btn-primary">Save</button>
                    <a class="btn btn-sm btn-default pull-right" href="{{ redirect()->back()->getTargetUrl() }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
                </div>
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>             
 <script>
    $(document).ready(function() {
    $("#word_count").on('keyup', function() {
        var words = this.value.split(' ').length;
        if (words > 23) {
            // Split the string on first 80 words and rejoin on spaces
            var trimmed = $(this).val().split(' ',23).join(" ");
            // Add a space at the end to keep new typing making new words
            $(this).val(trimmed + " ");
        }
        
    });
 });
     
 </script>               