<style>
  .message {
    border: 4px double #ccc;
    margin: 10px;
    padding: 10px;
    background-color: #fafafa;
  }
  .msg_title {
    margin: 10px 20px;
    text-color: #999;
    font-size: 16pt;
    font-weight: bold;
  }
  .msg_content {
    margin: 10px 20px;
    text-color: #aaa;
    font-size: 12pt;
  }
</style>

<div class="message">
  <p class="msg_title">{{$msg_title}}</p>
  <p class="msg_content">{{$msg_content}}</p>
</div>