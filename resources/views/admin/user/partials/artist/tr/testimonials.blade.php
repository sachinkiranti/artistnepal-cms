<tr class="testimonial-row {{ ($isDefault ?? true) ? 'default-testimonial-template' : '' }}">
    <input type="hidden" name="testimonials[{{ $index ?? null }}][id]" class="form-control" value="{{ $testimonial['id'] ?? '' }}">
    <td>
        <textarea name="testimonials[{{ $index ?? null }}][content]" class="form-control" rows="2">{{ $testimonial['content'] ?? '' }}</textarea>
    </td>
    <td>
        <input type="text" name="testimonials[{{ $index ?? null }}][endorser]" class="form-control" value="{{ $testimonial['endorser'] ?? '' }}">
    </td>
    <td>
        <input type="text" name="testimonials[{{ $index ?? null }}][endorser_title]" class="form-control" value="{{ $testimonial['endorser_title'] ?? '' }}">
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-xs remove-row">
            <i class="fa fa-trash"></i>
        </button>
    </td>
</tr>
