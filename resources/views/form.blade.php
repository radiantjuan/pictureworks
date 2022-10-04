<hr />
<h2>Add comment to a user</h2>
<form method="post" action="{{route('users.add.comment')}}" id="commentForm">
    {{method_field('PUT')}}
    {{csrf_field()}}
    <div>
        <span class="invalid-feedback invalid-feedback-id">
            @error('id')
            {{$message}}
            @enderror
        </span>

        <select id="id" name="id" class="@error('id')invalid @enderror js-users-lists">
            <option value="0">Choose a user</option>
            @foreach($users_list as $user_list_item)
                <option value="{{$user_list_item->id}}" @if((int)request('id') === $user_list_item->id) selected @endif>{{$user_list_item->name}}</option>
            @endforeach
        </select>
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
