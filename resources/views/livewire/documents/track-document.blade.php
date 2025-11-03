<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>DTS-ZPPSU | Document Tracking System</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/img/hd-logo.png') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <style>
    :root {
      --primary: #800000;
      --secondary: #ffc107;
      --light-gray: #f5f5f5;
      --dark-gray: #757575;
      --success: #4caf50;
      --warning: #ff9800;
      --info: #2196f3;
    }

    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      background-color: #fafafa;
      color: #333;
      line-height: 1.6;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 20px;
    }

    .tracking-container {
      background-color: white;
      border-radius: 8px;
      padding: 25px;
      margin-top: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .tracking-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 15px;
      border-bottom: 1px solid #eee;
    }

    .order-id {
      font-size: 18px;
      font-weight: 600;
    }

    .order-id span {
      color: var(--primary);
    }

    .tracking-progress {
      display: flex;
      justify-content: space-between;
      position: relative;
      margin: 40px 0;
    }

    .progress-line {
      position: absolute;
      height: 3px;
      background-color: #e0e0e0;
      top: 15px;
      left: 0;
      right: 0;
      z-index: 1;
    }

    .progress-line-active {
      background-color: var(--primary);
      width: 0%;
      transition: width 0.5s ease;
    }

    .status-step {
      display: flex;
      flex-direction: column;
      align-items: center;
      z-index: 2;
      flex: 1;
    }

    .status-icon {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background-color: #e0e0e0;
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 10px;
      color: white;
      transition: all 0.3s ease;
    }

    .status-icon.active {
      background-color: var(--primary);
      transform: scale(1.1);
    }

    .status-icon.completed {
      background-color: var(--success);
    }

    .status-icon.delayed {
      background-color: var(--warning);
    }

    .status-label {
      font-size: 14px;
      text-align: center;
      color: var(--dark-gray);
      transition: all 0.3s ease;
    }

    .status-label.active {
      color: var(--primary);
      font-weight: 600;
    }

    .status-date {
      font-size: 12px;
      color: var(--dark-gray);
      margin-top: 5px;
      transition: all 0.3s ease;
    }

    .status-date.active {
      color: var(--primary);
      font-weight: 500;
    }

    .courier-info {
      background-color: var(--light-gray);
      padding: 15px;
      border-radius: 8px;
      margin: 30px 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .courier-name {
      font-weight: 600;
    }

    .tracking-link {
      color: var(--primary);
      text-decoration: none;
      font-weight: 500;
    }

    .status-updates h3 {
      margin-top: 20px;
    }

    .update-card {
      display: flex;
      padding: 15px 0;
      border-bottom: 1px solid #eee;
      transition: background-color 0.2s;
    }

    .update-card:hover {
      background-color: #f9f9f9;
    }

    .update-icon {
      margin-right: 15px;
      color: var(--primary);
    }

    .update-time {
      color: var(--dark-gray);
      font-size: 13px;
    }

    .action-buttons {
      text-align: right;
      margin-top: 20px;
    }

    .btn {
      padding: 10px 20px;
      border-radius: 4px;
      font-weight: 500;
      cursor: pointer;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-primary {
      background-color: var(--primary);
      color: white;
    }

    .btn-primary:hover {
      background-color: #600000;
    }

    .btn-outline {
      background-color: transparent;
      border: 1px solid var(--primary);
      color: var(--primary);
    }

    .btn-outline:hover {
      background-color: rgba(128, 0, 0, 0.1);
    }

    /* Additional styles for advanced features */
    .document-details {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 15px;
      margin: 20px 0;
    }

    .detail-card {
      background-color: var(--light-gray);
      padding: 15px;
      border-radius: 6px;
      min-height: 80px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .detail-label {
      font-size: 13px;
      color: var(--dark-gray);
      margin-bottom: 5px;
    }

    .detail-value {
      font-weight: 500;
      font-size: 14px;
    }

    .estimated-time {
      display: flex;
      align-items: center;
      margin-top: 10px;
      color: var(--dark-gray);
      font-size: 14px;
    }

    .estimated-time i {
      margin-right: 8px;
      color: var(--warning);
    }

    .action-buttons {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .action-buttons .btn-group {
      display: flex;
      gap: 10px;
    }

    .alert-banner {
      background-color: #fff3cd;
      border: 1px solid #ffeaa7;
      color: #856404;
      padding: 12px 15px;
      border-radius: 6px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
    }

    .alert-banner i {
      margin-right: 10px;
      color: var(--warning);
    }

    .status-badge {
      display: inline-block;
      padding: 4px 10px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 500;
      margin-left: 10px;
    }

    .status-badge.filed {
      background-color: #e3f2fd;
      color: var(--info);
    }

    .status-badge.sent {
      background-color: #fff3e0;
      color: var(--warning);
    }

    .status-badge.processing {
      background-color: #e8f5e9;
      color: var(--success);
    }

    .status-badge.completed {
      background-color: #e8f5e9;
      color: var(--success);
    }

    .status-badge.delayed {
      background-color: #ffebee;
      color: #f44336;
    }

    .timeline-container {
      position: relative;
      margin: 30px 0;
    }

    .timeline {
      position: relative;
      max-width: 100%;
      margin: 0 auto;
    }

    .timeline::after {
      content: '';
      position: absolute;
      width: 3px;
      background-color: #e0e0e0;
      top: 0;
      bottom: 0;
      left: 50%;
      margin-left: -1.5px;
    }

    .timeline-item {
      padding: 10px 40px;
      position: relative;
      width: 50%;
      box-sizing: border-box;
    }

    .timeline-item::after {
      content: '';
      position: absolute;
      width: 16px;
      height: 16px;
      background-color: white;
      border: 3px solid var(--primary);
      border-radius: 50%;
      top: 15px;
      z-index: 1;
    }

    .timeline-item.left {
      left: 0;
    }

    .timeline-item.right {
      left: 50%;
    }

    .timeline-item.left::after {
      right: -8px;
    }

    .timeline-item.right::after {
      left: -8px;
    }

    .timeline-content {
      padding: 15px;
      background-color: white;
      border-radius: 6px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    .timeline-date {
      font-weight: 500;
      color: var(--primary);
      margin-bottom: 5px;
    }

    .timeline-desc {
      font-size: 14px;
      color: var(--dark-gray);
    }

    .document-preview {
      margin: 20px 0;
      border: 1px solid #eee;
      border-radius: 6px;
      overflow: hidden;
    }

    .preview-header {
      background-color: var(--light-gray);
      padding: 10px 15px;
      font-weight: 500;
    }

    .preview-content {
      padding: 15px;
      min-height: 150px;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
    }

    .preview-content i {
      font-size: 48px;
      color: var(--dark-gray);
      margin-bottom: 15px;
    }

    .progress-info {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
      font-size: 13px;
      color: var(--dark-gray);
    }

    .notification-toggle {
      display: flex;
      align-items: center;
      margin-top: 15px;
    }

    .toggle-label {
      margin-left: 10px;
      font-size: 14px;
    }

    /* Toggle Switch */
    .switch {
      position: relative;
      display: inline-block;
      width: 50px;
      height: 24px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: .4s;
      border-radius: 24px;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      transition: .4s;
      border-radius: 50%;
    }

    input:checked + .slider {
      background-color: var(--primary);
    }

    input:checked + .slider:before {
      transform: translateX(26px);
    }

    @media (max-width: 768px) {
      .document-details {
        grid-template-columns: repeat(2, 1fr);
      }

      .tracking-progress {
        flex-direction: column;
        align-items: flex-start;
        margin: 20px 0;
      }

      .status-step {
        flex-direction: row;
        margin-bottom: 15px;
        width: 100%;
      }

      .status-icon {
        margin-right: 15px;
        margin-bottom: 0;
      }

      .progress-line {
        display: none;
      }

      .action-buttons {
        flex-direction: column;
        gap: 10px;
      }

      .action-buttons .btn-group {
        width: 100%;
        justify-content: space-between;
      }

      .timeline::after {
        left: 31px;
      }

      .timeline-item {
        width: 100%;
        padding-left: 70px;
        padding-right: 25px;
      }

      .timeline-item.right {
        left: 0;
      }

      .timeline-item::after {
        left: 23px;
      }

      .timeline-item.right::after {
        left: 23px;
      }
    }

    @media (max-width: 480px) {
      .document-details {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 class="text-2xl font-bold mb-4">Document Tracking</h1>
    
    <div class="alert-banner">
      <i class="fas fa-info-circle"></i>
      <span>Document tracking is updated in real-time. You'll receive notifications for status changes.</span>
    </div>

    <div class="tracking-container">
      <div class="tracking-header">
        <div class="order-id">Document Reference: <span id="document-number">{{ $document->document_number }}</span></div>
        <div class="status-badge filed" id="status-badge">{{ ucfirst($document->status) }}</div>
      </div>

      <div class="document-details">
        <div class="detail-card">
          <div class="detail-label">Date Created</div>
          <div class="detail-value" id="doc-created">{{ $document->created_at->format('M d, Y') }}</div>
        </div>
        <div class="detail-card">
          <div class="detail-label">Document Type</div>
          <div class="detail-value" id="doc-type">
            {{ $document->documentType->name ?? $document->type ?? 'RLM' }}
          </div>
        </div>
        <div class="detail-card">
          <div class="detail-label">Priority</div>
          <div class="detail-value" id="doc-priority">
            {{ $document->priority_level ?? $document->priority ?? 'Normal' }}
          </div>
        </div>
        <div class="detail-card">
          <div class="detail-label">Expected Completion</div>
          <div class="detail-value" id="doc-expected">
            {{ $document->expected_completion_date ?? $document->expected_completion ?? '-' }}
          </div>
        </div>
      </div>

      <div class="tracking-progress">
        <div class="progress-line">
          <div class="progress-line-active" id="progress-bar"></div>
        </div>

        <div class="status-step" id="step-filed">
          <div class="status-icon"><i class="fas fa-edit"></i></div>
          <div class="status-label">Filed</div>
          <div class="status-date" id="date-filed">
            @php
              $filedLog = $document->status_logs ? $document->status_logs->where('status', 'filed')->first() : null;
            @endphp
            {{ $filedLog ? $filedLog->created_at->format('M d, h:i A') : '-' }}
          </div>
        </div>

        <div class="status-step" id="step-sent">
          <div class="status-icon"><i class="fas fa-share"></i></div>
          <div class="status-label">Sent</div>
          <div class="status-date" id="date-sent">
            @php
              $sentLog = $document->status_logs ? $document->status_logs->where('status', 'sent')->first() : null;
            @endphp
            {{ $sentLog ? $sentLog->created_at->format('M d, h:i A') : '-' }}
          </div>
        </div>

        <div class="status-step" id="step-processing">
          <div class="status-icon"><i class="fas fa-hourglass-half"></i></div>
          <div class="status-label">Processing</div>
          <div class="status-date" id="date-processing">
            @php
              $processingLog = $document->status_logs ? $document->status_logs->where('status', 'processing')->first() : null;
            @endphp
            {{ $processingLog ? $processingLog->created_at->format('M d, h:i A') : '-' }}
          </div>
        </div>

        <div class="status-step" id="step-completed">
          <div class="status-icon"><i class="fas fa-check-circle"></i></div>
          <div class="status-label">Completed</div>
          <div class="status-date" id="date-completed">
            @php
              $completedLog = $document->status_logs ? $document->status_logs->where('status', 'completed')->first() : null;
            @endphp
            {{ $completedLog ? $completedLog->created_at->format('M d, h:i A') : '-' }}
          </div>
        </div>
      </div>

      <div class="progress-info">
        <div>
        <span class="status-text">Current Status:</span>
        <span class="status-value" id="current-status-text">
            {{ ucfirst($document->status) }}
        </span>
        <style>
        .status-text {
            color: #3a3838ff;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .status-value {
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.25rem 0.75rem;
            border-radius: 0.375rem;
            margin-left: 0.5rem;
            display: inline-block;
            transition: all 0.3s ease;
        }
        </style>
        </div>
      </div>

      <div class="courier-info">
        <div>
          <div class="courier-name">Subject: <span id="document-subject">{{ $document->subject }}</span></div>
          <div class="tracking-number">Status: <span id="document-status">{{ ucfirst($document->status) }}</span></div>
          <div class="tracking-number">Assigned To: <span id="assigned-to">
            @if($document->current_office_id && $document->currentOffice)
              {{ $document->currentOffice->name }}
            @elseif($document->office_id && $document->office)
              {{ $document->office->name }}
            @elseif($document->assigned_to)
              {{ $document->assigned_to }}
            @elseif($document->current_office)
              {{ $document->current_office }}
            @else
              -
            @endif
          </span></div>
        </div>
        <a href="#" class="tracking-link" id="history-link">View History <i class="fas fa-external-link-alt"></i></a>
      </div>

      <div class="timeline-container">
        <h3>Document Timeline</h3>
        <div class="timeline" id="document-timeline">
          <!-- Timeline items will be dynamically added here -->
        </div>
      </div>

      <div class="status-updates">
        <h3>Document Activity Logs</h3>
        <div id="activity-logs">
          @if($document->logs)
            @foreach($document->logs->sortByDesc('created_at') as $log)
            <div class="update-card">
              <div class="update-icon">
                @if($log->action == 'Document Sent')
                  <i class="fas fa-share-square"></i>
                @else
                  <i class="fas fa-info-circle"></i>
                @endif
              </div>
              <div>
                <div>
                  @if($log->action == 'Document Sent')
                    Document Sent
                  @elseif(strpos($log->action, 'viewed') !== false)
                    {{ $log->description }}
                  @else
                    {{ $log->description }}
                  @endif
                </div>
                <div class="update-time">{{ $log->created_at->format('F d, Y h:i A') }}</div>
              </div>
            </div>
            @endforeach
          @else
            <div class="update-card">
              <div class="update-icon">
                <i class="fas fa-info-circle"></i>
              </div>
              <div>
                <div>No activity logs available</div>
                <div class="update-time">-</div>
              </div>
            </div>
          @endif
        </div>
      </div>

      <div class="notification-toggle">
        <label class="switch">
          <input type="checkbox" id="notification-toggle" checked>
          <span class="slider"></span>
        </label>
        <span class="toggle-label">Receive real-time status notifications</span>
      </div>

      <div class="action-buttons">
        <div class="btn-group">
          <button class="btn btn-outline" id="share-btn">
            <i class="fas fa-share-alt"></i> Share Tracking
          </button>
          <button class="btn btn-outline" id="print-btn">
            <i class="fas fa-print"></i> Print Summary
          </button>
        </div>
        <button class="btn btn-primary" id="contact-btn">
          <i class="fas fa-envelope"></i> Contact Office
        </button>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Extract document data from the PHP template variables with safe fallbacks
      const documentData = {
        id: '{{ $document->document_number }}',
        subject: '{{ $document->subject }}',
        type: '{{ $document->documentType->name ?? $document->type ?? "RLM" }}',
        priority: '{{ $document->priority_level ?? $document->priority ?? "Normal" }}',
        status: '{{ strtolower($document->status) }}',
        createdDate: '{{ $document->created_at->format("M d, Y") }}',
        expectedCompletion: '{{ $document->expected_completion_date ?? $document->expected_completion ?? "" }}',
        assignedTo: document.getElementById('assigned-to').textContent.trim(),
        statusDates: {
          filed: document.getElementById('date-filed').textContent.trim(),
          sent: document.getElementById('date-sent').textContent.trim(),
          processing: document.getElementById('date-processing').textContent.trim(),
          completed: document.getElementById('date-completed').textContent.trim()
        },
        timeline: [
          { 
            date: '{{ $document->created_at->format("M d, Y") }}', 
            title: 'Document Created', 
            description: 'Document drafted and prepared for submission' 
          }
          @if($document->status_logs)
            @php
              $filedLog = $document->status_logs->where('status', 'filed')->first();
              $sentLog = $document->status_logs->where('status', 'sent')->first();
              $processingLog = $document->status_logs->where('status', 'processing')->first();
              $completedLog = $document->status_logs->where('status', 'completed')->first();
            @endphp
            @if($filedLog)
            ,{
              date: '{{ $filedLog->created_at->format("M d, h:i A") }}',
              title: 'Document Filed',
              description: 'Document officially filed in the system'
            }
            @endif
            @if($sentLog)
            ,{
              date: '{{ $sentLog->created_at->format("M d, h:i A") }}',
              title: 'Document Sent',
              description: 'Document forwarded to ' + document.getElementById('assigned-to').textContent.trim() + ' for review'
            }
            @endif
            @if($processingLog)
            ,{
              date: '{{ $processingLog->created_at->format("M d, h:i A") }}',
              title: 'Document Processing',
              description: 'Document is being reviewed and processed'
            }
            @endif
            @if($completedLog)
            ,{
              date: '{{ $completedLog->created_at->format("M d, h:i A") }}',
              title: 'Document Completed',
              description: 'Document processing has been completed'
            }
            @endif
          @endif
        ],
        activityLogs: []
      };

      // Initialize the tracking system
      initTrackingSystem(documentData);

      // Function to initialize the tracking system
      function initTrackingSystem(data) {
        console.log('Initializing tracking system with status:', data.status);
        
        // Update status indicators using DYNAMIC SYSTEM ONLY
        updateStatusIndicators(data.status);
        
        // Build timeline
        buildTimeline(data.timeline);
        
        // Add event listeners
        addEventListeners();
        
        // Start real-time updates
        startRealTimeUpdates();
      }

      // DYNAMIC PROGRESS SYSTEM - Calculates progress based on status index
      function updateStatusIndicators(status) {
        console.log('Updating status indicators for:', status);
        
        const steps = ['filed', 'sent', 'processing', 'completed'];
        const statusIndex = steps.indexOf(status);
        
        console.log('Status index:', statusIndex);
        
        // Update status badge
        const statusBadge = document.getElementById('status-badge');
        statusBadge.className = 'status-badge ' + status;
        statusBadge.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        
        // Update current status text
        const currentStatusText = document.getElementById('current-status-text');
        currentStatusText.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        
        // Update status colors dynamically
        const statusColor = getStatusColor(status);
        const bgColor = getStatusBgColor(status);
        currentStatusText.style.color = statusColor;
        currentStatusText.style.backgroundColor = bgColor;
        
        // Update document status in courier info
        document.getElementById('document-status').textContent = status.charAt(0).toUpperCase() + status.slice(1);
        
        if (statusIndex === -1) {
          console.log('Status not found in steps array');
          return;
        }
        
        // Reset all steps
        steps.forEach(step => {
          const stepElement = document.getElementById(`step-${step}`);
          const icon = stepElement.querySelector('.status-icon');
          const label = stepElement.querySelector('.status-label');
          const date = stepElement.querySelector('.status-date');
          
          icon.classList.remove('completed', 'active', 'delayed');
          label.classList.remove('active');
          date.classList.remove('active');
        });
        
        // Set appropriate classes for each step based on current status
        for (let i = 0; i <= statusIndex; i++) {
          const stepElement = document.getElementById(`step-${steps[i]}`);
          const icon = stepElement.querySelector('.status-icon');
          const label = stepElement.querySelector('.status-label');
          const date = stepElement.querySelector('.status-date');
          
          if (i < statusIndex) {
            // Previous steps are completed
            icon.classList.add('completed');
          } else {
            // Current step is active
            icon.classList.add('active');
            label.classList.add('active');
            date.classList.add('active');
          }
        }
        
        // DYNAMIC PROGRESS CALCULATION - Based on status index
        const progressBar = document.getElementById('progress-bar');
        const progressPercentage = (statusIndex / (steps.length - 1)) * 100;
        progressBar.style.width = `${progressPercentage}%`;
        
        console.log('Dynamic progress calculation - Status:', status, 'Index:', statusIndex, 'Progress:', progressPercentage + '%');
      }
      
      // Function to get status color
      function getStatusColor(status) {
        switch(status) {
          case 'filed': return '#2196f3';
          case 'sent': return '#ff9800';
          case 'processing': return '#4caf50';
          case 'completed': return '#0e743c';
          default: return '#6B7280';
        }
      }
      
      // Function to get status background color
      function getStatusBgColor(status) {
        switch(status) {
          case 'filed': return '#e3f2fd';
          case 'sent': return '#fff3e0';
          case 'processing': return '#e8f5e9';
          case 'completed': return '#f3f4f6';
          default: return '#F3F4F6';
        }
      }
      
      // Function to build timeline
      function buildTimeline(timelineData) {
        const timelineContainer = document.getElementById('document-timeline');
        timelineContainer.innerHTML = '';
        
        timelineData.forEach((item, index) => {
          const timelineItem = document.createElement('div');
          timelineItem.className = `timeline-item ${index % 2 === 0 ? 'left' : 'right'}`;
          
          timelineItem.innerHTML = `
            <div class="timeline-content">
              <div class="timeline-date">${item.date}</div>
              <div class="timeline-title">${item.title}</div>
              <div class="timeline-desc">${item.description}</div>
            </div>
          `;
          
          timelineContainer.appendChild(timelineItem);
        });
      }
      
      // Function to add event listeners
      function addEventListeners() {
        // History link
        document.getElementById('history-link').addEventListener('click', function(e) {
          e.preventDefault();
          alert('Opening full document history...');
        });
        
        // Share button
        document.getElementById('share-btn').addEventListener('click', function() {
          const shareUrl = `${window.location.origin}/tracking/${documentData.id}`;
          if (navigator.share) {
            navigator.share({
              title: 'Document Tracking',
              text: `Track document ${documentData.id}`,
              url: shareUrl
            });
          } else {
            // Fallback for browsers that don't support Web Share API
            navigator.clipboard.writeText(shareUrl).then(() => {
              alert('Tracking link copied to clipboard!');
            });
          }
        });
        
        // Print button
        document.getElementById('print-btn').addEventListener('click', function() {
          window.print();
        });
        
        // Contact button
        document.getElementById('contact-btn').addEventListener('click', function() {
          alert('Opening contact form...');
        });
        
        // Notification toggle
        document.getElementById('notification-toggle').addEventListener('change', function(e) {
          if (e.target.checked) {
            alert('Real-time notifications enabled');
          } else {
            alert('Real-time notifications disabled');
          }
        });
      }

      // Function to start real-time updates
      function startRealTimeUpdates() {
        // Check for updates every 30 seconds
        setInterval(fetchDocumentUpdates, 30000);
        
        // Also check immediately on page load
        fetchDocumentUpdates();
      }
      
      // Function to fetch document updates from the server
      function fetchDocumentUpdates() {
        const documentId = documentData.id;
        
        fetch(`/api/documents/${documentId}/tracking`)
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.json();
          })
          .then(updatedData => {
            // Update the UI with the new data using DYNAMIC SYSTEM
            updateTrackingUI(updatedData);
          })
          .catch(error => {
            console.error('Error fetching document updates:', error);
          });
      }
      
      // Function to update the tracking UI with new data
      function updateTrackingUI(updatedData) {
        // Update status if changed
        if (updatedData.status && updatedData.status !== documentData.status) {
          console.log('Status changed from', documentData.status, 'to', updatedData.status);
          documentData.status = updatedData.status;
          
          // Use DYNAMIC SYSTEM to update all indicators
          updateStatusIndicators(updatedData.status);
          
          // Show notification if enabled
          if (document.getElementById('notification-toggle').checked) {
            showStatusChangeNotification(updatedData.status);
          }
        }
        
        // Update assigned to if changed
        if (updatedData.assignedTo && updatedData.assignedTo !== documentData.assignedTo) {
          documentData.assignedTo = updatedData.assignedTo;
          document.getElementById('assigned-to').textContent = updatedData.assignedTo;
        }
        
        // Update status dates if available
        if (updatedData.statusDates) {
          Object.keys(updatedData.statusDates).forEach(status => {
            if (updatedData.statusDates[status] && updatedData.statusDates[status] !== '-') {
              document.getElementById(`date-${status}`).textContent = updatedData.statusDates[status];
              documentData.statusDates[status] = updatedData.statusDates[status];
            }
          });
        }
        
        // Update timeline if available
        if (updatedData.timeline && updatedData.timeline.length > documentData.timeline.length) {
          documentData.timeline = updatedData.timeline;
          buildTimeline(updatedData.timeline);
        }
        
        // Update activity logs if available
        if (updatedData.activityLogs && updatedData.activityLogs.length > 0) {
          updateActivityLogs(updatedData.activityLogs);
        }
      }
      
      // Function to update activity logs
      function updateActivityLogs(newLogs) {
        const activityLogsContainer = document.getElementById('activity-logs');
        
        newLogs.forEach(log => {
          // Check if this log already exists
          const existingLogs = activityLogsContainer.querySelectorAll('.update-card');
          let logExists = false;
          
          existingLogs.forEach(existingLog => {
            const logTime = existingLog.querySelector('.update-time').textContent;
            if (logTime === log.created_at) {
              logExists = true;
            }
          });
          
          if (!logExists) {
            // Add the new log at the top
            const logElement = document.createElement('div');
            logElement.className = 'update-card';
            
            let iconClass = 'fas fa-info-circle';
            if (log.action === 'Document Sent') {
              iconClass = 'fas fa-share-square';
            }
            
            logElement.innerHTML = `
              <div class="update-icon">
                <i class="${iconClass}"></i>
              </div>
              <div>
                <div>${log.description}</div>
                <div class="update-time">${log.created_at}</div>
              </div>
            `;
            
            activityLogsContainer.insertBefore(logElement, activityLogsContainer.firstChild);
          }
        });
      }
      
      // Function to show status change notification
      function showStatusChangeNotification(newStatus) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'alert-banner';
        notification.style.position = 'fixed';
        notification.style.top = '20px';
        notification.style.right = '20px';
        notification.style.zIndex = '1000';
        notification.style.maxWidth = '300px';
        notification.style.boxShadow = '0 4px 12px rgba(0,0,0,0.15)';
        
        notification.innerHTML = `
          <i class="fas fa-bell"></i>
          <span>Document status updated to: ${newStatus}</span>
          <button style="margin-left: auto; background: none; border: none; cursor: pointer;">
            <i class="fas fa-times"></i>
          </button>
        `;
        
        document.body.appendChild(notification);
        
        // Add click event to close button
        notification.querySelector('button').addEventListener('click', function() {
          document.body.removeChild(notification);
        });
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
          if (document.body.contains(notification)) {
            document.body.removeChild(notification);
          }
        }, 5000);
      }
    });
  </script>
</body>
</html>