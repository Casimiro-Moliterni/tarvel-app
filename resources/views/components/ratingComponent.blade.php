{{-- @props(['trip', 'stop'])
<div class="my-wrapper-star" id="ratingComponentWrapper-{{ $stop }}">
    <div class="rating-wrap">
        <h2>Star Rating</h2>
        @dump($stop)
        <div class="center">
            <form data-url-rating="{{ route('admin.ratings.store') }}" class="form-rating d-flex flex-column">
                @csrf
                <fieldset class="rating ms-auto me-auto">
                    <input type="radio" id="star5" name="rating" value="5" class="star-input"/><label for="star5"
                        class="full" title="Awesome"></label>
                    <input type="radio" id="star4" name="rating" value="4" class="star-input"/><label for="star4"
                        class="full"></label>
                    <input type="radio" id="star3" name="rating" value="3" class="star-input"/><label for="star3"
                        class="full"></label>
                    <input type="radio" id="star2" name="rating" value="2" class="star-input"/><label for="star2"
                        class="full"></label>
                    <input type="radio" id="star1" name="rating" value="1" class="star-input" /><label for="star1"
                        class="full"></label>
                    <input type="hidden" name="trip_id" value="{{ $trip}}">
                    <input type="hidden" name="stop_id" value="{{ $stop}}">
                    <div class="error"></div>
                </fieldset>
                <header>
                    <div></div>
                </header>
                <div class="textarea">
                    <textarea name="review" id="review" class="review" cols="30"></textarea>
                </div>
                <h4 id="rating-value" class="rating-value" class="my-3"></h4>
                <div class="my-btn">
                    <button type="submit" id="submit-btn" class="btn btn-primary">Invia</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    @import url(https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css);


    .rating-wrap {
        max-width: 480px;
        margin: auto;
        padding: 15px;
        box-shadow: 0 0 3px 0 rgba(0, 0, 0, .2);
        text-align: center;
    }

    .center {
        /* width: 162px; */
        margin: auto;
    }


    #rating-value {
        width: 110px;
        height:40px;
        margin: 40px auto 0;
        padding: 10px 5px;
        text-align: center;
        box-shadow: inset 0 0 2px 1px rgba(46, 204, 113, .2);
    }

    /*styling star rating*/
    .rating {
        border: none;
        float: left;
    }

    .rating>input {
        
        display: none;
    }

    .rating>label:before {
        content: '\f005';
        font-family: FontAwesome;
        margin: 5px;
        font-size: 5rem;
        display: inline-block;
        cursor: pointer;
    }

    .rating>.half:before {
        content: '\f089';
        position: absolute;
        cursor: pointer;
    }


    .rating>label {
        color: #ddd;
        float: right;
        cursor: pointer;
    }

    .rating>input:checked~label,
    .rating:not(:checked)>label:hover,
    .rating:not(:checked)>label:hover~label {
        color: #2ce679;
    }

    .rating>input:checked+label:hover,
    .rating>input:checked~label:hover,
    .rating>label:hover~input:checked~label,
    .rating>input:checked~label:hover~label {
        color: #2ddc76;
    }
</style> --}}
