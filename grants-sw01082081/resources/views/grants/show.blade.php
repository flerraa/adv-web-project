@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Grant Details</h2>
        <div>
            <a href="{{ route('grants.edit', $grant->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit Grant
            </a>
            <a href="{{ route('grants.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Grant Details Card -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Grant Information</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Title:</div>
                        <div class="col-md-8">{{ $grant->title }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Amount:</div>
                        <div class="col-md-8">${{ number_format($grant->amount, 2) }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Provider:</div>
                        <div class="col-md-8">{{ $grant->provider }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Start Date:</div>
                        <div class="col-md-8">{{ $grant->start_date->format('d M Y') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">Duration:</div>
                        <div class="col-md-8">{{ $grant->duration_months }} months</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4 fw-bold">End Date:</div>
                        <div class="col-md-8">{{ $grant->start_date->addMonths($grant->duration_months)->format('d M Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Team Members Card -->
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Project Team</h5>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addMemberModal">
                        <i class="fas fa-plus"></i> Add Member
                    </button>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6 class="fw-bold">Project Leader</h6>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-tie fa-2x me-3"></i>
                            <div>
                                <div>{{ $grant->projectLeader->name }}</div>
                                <small class="text-muted">{{ $grant->projectLeader->position }}</small>
                            </div>
                        </div>
                    </div>

                    <h6 class="fw-bold">Team Members</h6>
                    @if($grant->members->count() > 0)
                        <div class="list-group">
                            @foreach($grant->members as $member)
                                <div class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <div>{{ $member->name }}</div>
                                        <small class="text-muted">{{ $member->position }}</small>
                                    </div>
                                    <form action="{{ route('grants.remove-member', $grant->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="member_id" value="{{ $member->id }}">
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Remove this member?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No team members added yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Milestones Section -->
    <div class="card">
        <div class="card-header bg-info text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Project Milestones</h5>
            <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#addMilestoneModal">
                <i class="fas fa-plus"></i> Add Milestone
            </button>
        </div>
        <div class="card-body">
            @if($grant->milestones->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Target Date</th>
                                <th>Deliverable</th>
                                <th>Status</th>
                                <th>Last Updated</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($grant->milestones as $milestone)
                                <tr>
                                    <td>{{ $milestone->name }}</td>
                                    <td>{{ $milestone->target_date->format('d M Y') }}</td>
                                    <td>{{ $milestone->deliverable }}</td>
                                    <td>
                                        <x-status-badge :status="$milestone->status" />
                                    </td>
                                    <td>{{ $milestone->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#updateStatusModal{{ $milestone->id }}">
                                            <i class="fas fa-sync-alt"></i>
                                        </button>
                                        <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted">No milestones created yet.</p>
            @endif
        </div>
    </div>
</div>

<!-- Add Member Modal -->
<div class="modal fade" id="addMemberModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Team Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('grants.add-member', $grant->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="member_id" class="form-label">Select Member</label>
                        <select name="member_id" id="member_id" class="form-control select2" required>
                            <option value="">Select a member...</option>
                            @foreach($availableMembers as $member)
                                <option value="{{ $member->id }}">
                                    {{ $member->name }} ({{ $member->position }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Member</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Milestone Modal -->
<div class="modal fade" id="addMilestoneModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Milestone</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('milestones.store') }}" method="POST">
                @csrf
                <input type="hidden" name="grant_id" value="{{ $grant->id }}">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Milestone Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="target_date" class="form-label">Target Date</label>
                        <input type="date" class="form-control" id="target_date" name="target_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="deliverable" class="form-label">Deliverable</label>
                        <textarea class="form-control" id="deliverable" name="deliverable" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Milestone</button>
                </div>
            </form>
        </div>
    </div>
</div>

@foreach($grant->milestones as $milestone)
<!-- Update Status Modal for each milestone -->
<div class="modal fade" id="updateStatusModal{{ $milestone->id }}" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Milestone Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('milestones.update-status', $milestone->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="Pending" {{ $milestone->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="In Progress" {{ $milestone->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="Completed" {{ $milestone->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Update Remark</label>
                        <textarea name="remark" id="remark" class="form-control" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

@push('scripts')
<script>
    $(document).ready(function() {
        // Initialize Select2 for member selection
        $('#member_id').select2({
            dropdownParent: $('#addMemberModal')
        });

        // Date validation for milestones
        $('#target_date').attr('min', '{{ $grant->start_date->format("Y-m-d") }}')
            .attr('max', '{{ $grant->start_date->addMonths($grant->duration_months)->format("Y-m-d") }}');
    });
</script>
@endpush
@endsection
