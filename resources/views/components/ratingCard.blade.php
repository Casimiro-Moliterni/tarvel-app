<span class="star__container">
    <input type="radio" name="rating" value="1" id="star-1" class="star__radio visuhide">
    <input type="radio" name="rating" value="2" id="star-2" class="star__radio visuhide">
    <input type="radio" name="rating" value="3" id="star-3" class="star__radio visuhide">
    <input type="radio" name="rating" value="4" id="star-4" class="star__radio visuhide">
    <input type="radio" name="rating" value="5" id="star-5" class="star__radio visuhide">
  
    <label class="star__item" for="star-1"><span class="visuhide">1 star</span></label>
    <label class="star__item" for="star-2"><span class="visuhide">2 stars</span></label>
    <label class="star__item" for="star-3"><span class="visuhide">3 stars</span></label>
    <label class="star__item" for="star-4"><span class="visuhide">4 stars</span></label>
    <label class="star__item" for="star-5"><span class="visuhide">5 stars</span></label>
  </span>

  <style>
    $rating-emoji: '⭐️' !default;
//$rating-emoji: '💛';
*, *::before, *::after { box-sizing: border-box; }

html,
body {
  height: 100%;
  font-size: 32px;
}

body {
  display: flex;
  margin: 0;
  background-color: #e6e6e6;
}

.visuhide {
  position: absolute !important;
  overflow: hidden;
  width: 1px;
  height: 1px;
  clip: rect(1px,1px,1px,1px);
}

%star-active { filter: grayscale(0); }
%star-inactive { filter: grayscale(1); }

.star {
  $p: &;
  $star_count: 5;
  
  @for $i from 1 through $star_count {
    &__container:not(:hover) > &__radio:nth-of-type(#{$i}):checked ~ &__item:nth-of-type(#{$i}) ~ &__item {
      @extend %star-inactive;
    }
    
    &__radio:nth-of-type(#{$i}):checked ~ &__item:nth-of-type(#{$i})::before {
      transform: scale(1.5);
      transition-timing-function: cubic-bezier(.5,1.5,.25,1);
    }
  }
  
  &__container {
    display: flex;
    margin: auto;
    border-radius: .25em;
    background-color: #00a39b;
    box-shadow: 0 .25em 1em rgba(0,0,0,.25);
    transition: box-shadow .3s ease;
    
    &:focus-within {
      box-shadow: 0 0.125em .5em rgba(0,0,0,.5);
    }
  }
  
  &__item {
    display: inline-flex;
    width: 1.25em;
    height: 1.5em;
    @extend %star-inactive;
    
    &::before {
      content: $rating-emoji;
      display: inline-block;
      margin: auto;
      font-size: .75em;
      vertical-align: top;
      backface-visibility: hidden;
      transform-origin: 50% 33.3%;
      transition: transform .3s ease-out;
    }
    
    // Active all stars when the container is hovered…
    #{$p}__container:hover &,
    #{$p}__radio:checked ~ & { 
      @extend %star-active;
    }
    // Then deactivate the ones that are after the hovered star
    &:hover ~ & {
      @extend %star-inactive;
    }
  }
}
  </style>