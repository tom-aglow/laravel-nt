 <div class="row">
    <div class="col l6 offset-l3">
        <h4>Create a new thread</h4>
        <form action="{{ route('client.threads.index') }}" method="post">
            {{ csrf_field() }}
            <div class="input-field col l12">
                <select id="channel" name="channel_id">
                    <option value="" disabled selected>Select channel</option>
                    @foreach(App\Models\Channel::all() as $channel)
                        <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>{{ $channel->name }}</option>
                    @endforeach
                </select>
                <label for="channel">Thread channel</label>
            </div>
            <br><br>
            <div class="input-field col l12">
                <input id="title" type="text" class="validate" name="title" placeholder="Enter a title" value="{{ old('title') }}" required>
                <label for="title" data-error="wrong" data-success="right">Title</label>
            </div>
            <div class="input-field col l12">
                <textarea id="body" class="materialize-textarea" rows="6" name="body" class="validate" placeholder="Enter thread text" required>{{ old('body') }}</textarea>
                <label for="body" data-error="wrong" data-success="right">Text</label>
            </div>
            <input type="submit" value="Publish" class="btn">
        </form>
        @if ($errors->any())
            <div>
                @foreach($errors->all() as $error)
                    <p class="red-text text-darken-4">{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>
