@extends('layouts.layout')

@section('title', 'Hotels')
@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.css" rel="stylesheet">
@endsection 
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote.min.js"></script>
@endsection
@section('content')
	<div class="d-flex justify-content-between align-items-center mb-3"
		style="background-color: #C0C0C0; color: #333; padding: 20px; border-radius: 5px;">
		<x-page-title title="Hotel" pagetitle="Add Hotel Details" />
		<a class="btn btn-primary" href="{{ route('hotels.index') }}"> Back</a>
	</div>

	<div class="row">
		<div class="col-lg-12 mx-auto">
			<div class="card">
				<div class="card-header px-4 py-3">
					<h5 class="mb-0">Add new Hotel</h5>
				</div>
				<div class="card-body p-4">
					<form id="hotelForm" method="POST" action="{{ route('hotels.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="row mb-3">
							<label for="input35" class="col-sm-3 col-form-label">Enter Hotel Name</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="input35" name="name" placeholder="Enter Hotel Name" required>
							</div>
						</div>
						<div class="row mb-3">
							<label class="col-sm-3 col-form-label">Location</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="location" placeholder="Location" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="input37a" class="col-sm-3 col-form-label">Rating</label>
							<div class="col-sm-9">
								<input type="number" min="1" max="5" class="form-control" id="input37a" name="rating" placeholder="Rating" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="input37" class="col-sm-3 col-form-label">Base Price</label>
							<div class="col-sm-9">
								<input type="number" class="form-control" id="input37" name="price" placeholder="Base Price" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="input37" class="col-sm-3 col-form-label">Image</label>
							<div class="col-sm-9">
								<input type="file" class="form-control"  name="image" placeholder="Image" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="input37" class="col-sm-3 col-form-label">Status</label>
							<div class="col-sm-9">
								<select class="form-control" name="status" id="input37">
									<option value="">Select Status</option>
									<option value="1">Active</option>
									<option value="0">Inactive</option>
								</select>
							</div>
						</div>

						<div class="form-group mb-3">
							<label><b>Categories</b></label><br>
							<div id="categoryFields">
								<div class="category-group row mb-3 p-3 border rounded">
									<!-- Category Group Fields -->
									<div class="col-md-4">
										<label for="rateType" class="form-label">Rate Type</label>
										<select name="rate_type[]" id="rateType" class="form-control" required>
											<option value="">Select Rate Type</option>
											<option value="2">Weekend</option>
											<option value="1">Weekdays</option>
										</select>
									</div>
									<div class="col-md-4">
										<label for="categoryType" class="form-label">Category Type</label>
										<select name="category_type[]" id="categoryType" class="form-control" required>
											<option value="">Select Category Type</option>
											<option value="1">Cat1</option>
											<option value="2">Cat2</option>
											<option value="3">Cat3</option>
										</select>
									</div>
									<div class="col-md-4">
										<label for="roomType" class="form-label">Room Type</label>
										<select name="room_type[]" id="roomType" class="form-control" required>
											<option value="">Select Room Type</option>
											<option value="single">Single Room</option>
											<option value="double">Double Room</option>
											<option value="triple">Triple Room</option>
										</select>
									</div>
									<div class="col-md-4">
										<label for="categoryPrice" class="form-label">Price</label>
										<input name="room_price[]" type="number" class="form-control" placeholder="Enter price" required>
									</div>
									<!-- Additional Fields -->
									<div class="col-md-4"><label class="form-label">Kids below 6</label><input name="kids_below6[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Kids above 6</label><input name="kids_above6[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Breakfast</label><input name="breakfast[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Lunch</label><input name="lunch[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Dinner</label><input name="dinner[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Breakfast Kids</label><input name="breakfastkids[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Lunch Kids</label><input name="lunchkids[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Dinner Kids</label><input name="dinnerkids[]" type="number" class="form-control" placeholder="Enter price" required></div>
									<div class="col-md-4"><label class="form-label">Extra Bed</label><input name="extrabed[]" type="number" class="form-control" placeholder="Enter price" required></div>
								</div>
							</div>
							<button type="button" class="btn btn-primary mt-3" onclick="appendCategoryField()">Add More Category</button>
						</div>

						<div class="row">
							<label class="col-sm-3 col-form-label"></label>
							<div class="col-sm-9">
								<div class="d-md-flex d-grid align-items-center gap-3">
									<button type="submit" class="btn btn-primary px-4" name="submit2">Save and Next</button>
									<button type="reset" class="btn btn-secondary px-4">Reset</button>
								</div>
							</div>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
@endsection  
<script>
    function appendCategoryField() {
        const categoryDiv = document.getElementById("categoryFields");
        const categoryContainer = document.createElement("div");
        categoryContainer.className = "category-group row mb-3 p-3 border rounded";

        // HTML structure for each category group
        categoryContainer.innerHTML = `
            <div class="col-md-4">
                <label class="form-label">Rate Type</label>
                <select name="rate_type[]" class="form-control" required>
                    <option value="">Select Rate Type</option>
                    <option value="2">Weekend</option>
                    <option value="1">Weekdays</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Category Type</label>
                <select name="category_type[]" class="form-control" required>
                    <option value="">Select Category Type</option>
                    <option value="1">Cat1</option>
                    <option value="2">Cat2</option>
                    <option value="3">Cat3</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Room Type</label>
                <select name="room_type[]" class="form-control" required>
                    <option value="">Select Room Type</option>
                    <option value="single">Single Room</option>
                    <option value="double">Double Room</option>
                    <option value="triple">Triple Room</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Price</label>
                <input name="room_price[]" type="number" class="form-control" placeholder="Enter price" required>
            </div>
            <!-- Additional Fields -->
            <div class="col-md-4"><label class="form-label">Kids below 6</label><input name="kids_below6[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Kids above 6</label><input name="kids_above6[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Breakfast</label><input name="breakfast[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Lunch</label><input name="lunch[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Dinner</label><input name="dinner[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Breakfast Kids</label><input name="breakfastkids[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Lunch Kids</label><input name="lunchkids[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Dinner Kids</label><input name="dinnerkids[]" type="number" class="form-control" placeholder="Enter price" required></div>
            <div class="col-md-4"><label class="form-label">Extra Bed</label><input name="extrabed[]" type="number" class="form-control" placeholder="Enter price" required></div>
        `;
        
        categoryDiv.appendChild(categoryContainer);
    }
</script>
