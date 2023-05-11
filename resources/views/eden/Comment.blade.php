<script>
    document.addEventListener('DOMContentLoaded', () => {

        const ratings = document.querySelectorAll('[name="rate"]');
        const labels = document.querySelectorAll('.rating > label');

        const change = (e) => {
            console.log(e.target.value);

        }
        const mouseenter = (e) => {
            document.getElementById('rating-hover-label').innerHTML = e.target.title;
        }
        const mouseleave = (e) => {

            document.getElementById('rating-hover-label').innerHTML = '';
        }

        ratings.forEach((el) => {
            el.addEventListener('change', change);
        });
        labels.forEach((el) => {
            el.addEventListener('mouseenter', mouseenter);
            el.addEventListener('mouseleave', mouseleave);
        });




    });
</script>

<div>نظرات شما درباره {{ $detail->title }}</div>
<div>
    <div class="comment-form">
        @if (\Session::has('comment_success'))
            <div class="alert alert-success">
                {!! \Session::get('comment_success') !!}
            </div>
        @endif

        @if (\Session::has('comment_error'))
            <div class="alert alert-danger">
                {!! \Session::get('comment_error') !!}
            </div>
        @endif
        <form action="{{ route('comment.client.store') }}#comment" id="comment" method="post">
            <input type="hidden" name="content_id" value="{{ $detail->id }}">

            @csrf
            <div>
                <div class="rating">
                    <span>امتیاز: </span>
                    <input name="rate" type="radio" id="st5" {{ old('rate') == '5' ? 'checked' : '' }}
                        value="5" />
                    <label for="st5" title="عالی"></label>
                    <input name="rate" type="radio" id="st4" {{ old('rate') == '4' ? 'checked' : '' }}
                        value="4" />
                    <label for="st4" title="خوب"></label>
                    <input name="rate" type="radio" id="st3" {{ old('rate') == '3' ? 'checked' : '' }}
                        value="3" />
                    <label for="st3" title="معمولی"></label>
                    <input name="rate" type="radio" id="st2" {{ old('rate') == '2' ? 'checked' : '' }}
                        value="2" />
                    <label for="st2" title="ضعیف"></label>
                    <input name="rate" type="radio" id="st1" {{ old('rate') == '1' ? 'checked' : '' }}
                        value="1" />
                    <label for="st1" title="بد"></label>
                    <span id="rating-hover-label"></span>
                </div>
            </div>

            <div>
                <label for="comment_name">نام:</label>
                <input id="comment_name" type="text" name="name" value="{{ old('name') }}">
            </div>
            <div>
                <label for="comment-text">پیام:</label>
                <textarea id="comment-text" name="comment">{{ old('comment') }}</textarea>
            </div>
            <button class="button button-blue g-recaptcha" data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit'
                data-action='submit'>ارسال نظر</button>
        </form>
    </div>

    @foreach ($detail->comments as $comment)
        @if ($comment['name'] != '' && $comment['comment'] != '')
            <div class="comment">
                <div class="aside">
                    <div class="name">{{ $comment['name'] }}</div>
                    <div class="date">{{ convertGToJ($comment['created_at']) }}</div>
                </div>
                <div class="article">
                    <div>
                        @for ($i = $comment->rate; $i >= 1; $i--)
                            <label></label>
                        @endfor
                    </div>
                    <div class="text">{!! $comment['comment'] !!}</div>
                </div>
            </div>
        @endif
    @endforeach
</div>
