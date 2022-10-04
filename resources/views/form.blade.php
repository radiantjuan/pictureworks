<hr />
<form method="post" action="" id="commentForm">
    {{method_field('PUT')}}
    {{csrf_field()}}
    <div>
        <span class="invalid-feedback invalid-feedback-id">
            @error('id')
            {{$message}}
            @enderror
        </span>
        <input type="text" id="id" name="id" class="@error('id')invalid @enderror" placeholder="Enter ID here"/>
        <label for="id">ID</label>
    </div>
    <div>
        <span class="invalid-feedback invalid-feedback-password">
            @error('password')
            {{$message}}
            @enderror
        </span>
        <input type="password" id="password" placeholder="Enter password here" name="password" class="@error('comment')invalid @enderror"/>
        <label for="password">Password</label>
    </div>
    <div>
        <span class="invalid-feedback invalid-feedback-comment">
            @error('comment')
                    {{$message}}
                    @enderror
        </span>
        <textarea placeholder="Enter comment here" id="comment" name="comment" class="@error('comment')invalid @enderror"></textarea>
        <label for="comment">Comment</label>
    </div>
    <div>
        <button type="submit" class="js-submit-btn">Submit</button>
    </div>
</form>
