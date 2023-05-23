<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Cek & Update aplikasi</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="./">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cek & Update aplikasi</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-body">
                    <div class="card-block">
                        <div class="code-window mt-2">
                            <div class="dots">
                                <div class="red"></div>
                                <div class="orange"></div>
                                <div class="green"></div>
                                <code>command : help/? | version | update | readme | clear | wa | ping</code>
                            </div>
                            <pre class="language-javascript line-numbers terminal"
                            style="height:500px;max-height:600px;"></pre>
                        </div>
                        
                    </div><!-- /.card -->
                </div><!-- /.card -->
            </div><!-- /.card -->
            
        </div>
    </div>
</div>
<style>
    .code-window {
    border-radius: .45rem;
    background-color: #000;
    padding: 1.52rem;
    box-shadow: 0 8px 24px 0 rgba(0, 0, 0, 0.1);
    }
    
    pre[class*="language-"].line-numbers {
    position: relative;
    padding: 0;
    counter-reset: linenumber;
    }
    
    pre[class*="language-"] {
    background: #000;
    }
</style>
<script src="<?= base_url('assets/'); ?>js/prism.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/prism-line-numbers.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/jquery.terminal.min.js"></script>
<script>
    $(function() {
        var nama = '<?= $nama; ?>';
        var anim = false;
        
        function typed(finish_typing) {
            return function(term, message, delay, finish) {
                anim = true;
                var prompt = term.get_prompt();
                var c = 0;
                if (message.length > 0) {
                    term.set_prompt('');
                    var new_prompt = '';
                    var interval = setInterval(function() {
                        var chr = $.terminal.substring(message, c, c + 1);
                        new_prompt += chr;
                        term.set_prompt(new_prompt);
                        c++;
                        if (c == length(message)) {
                            clearInterval(interval);
                            // execute in next interval
                            setTimeout(function() {
                                // swap command with prompt
                                finish_typing(term, message, prompt);
                                anim = false
                                finish && finish();
                            }, delay);
                        }
                    }, delay);
                }
            };
        }
        
        function length(string) {
            string = $.terminal.strip(string);
            return $('<span>' + string + '</span>').text().length;
        }
        var typed_prompt = typed(function(term, message, prompt) {
            term.set_prompt(message + ' ');
        });
        var typed_message = typed(function(term, message, prompt) {
            term.echo(message)
            term.set_prompt(prompt);
        });
        $('.terminal').terminal(function(command, term) {
            var finish = false;
            var msg = "..........";
            term.set_prompt('> ');
            typed_message(term, msg, 200, function() {
                finish = true;
            });
            var args = {
                command: command
            };
            
            $.post(base_url + 'updateversi/update_app', args).then(function(response) 
            {(function wait() {
                if (finish) {
                    
                    var json = $.parseJSON(response);
                    var json_arr = [];
                    
                    if (json.status == 'log') {
                        $.each(json, function(key, value) {
                            if (key == 'data') {
                                json_arr.push(value);
                            }
                        });
                        } else if (json.status == 'error') {
                        json_arr.push('[[gb;red;black]');
                        json_arr.push('command tidak ditemukan');
                        json_arr.push(']');
                        
                        } else {
                        $.each(json, function(key, value) {
                            json_arr.push(value + '\n');
                        });
                    }
                    
                    term.echo(json_arr);
                    
                    } else {
                    setTimeout(wait, 500);
                }
            })();
            }).fail(function(xhr, textStatus, errorThrown) {
            var pesan = JSON.parse(xhr.responseText);
            var json_arr = [];
            json_arr.push('[[b;red;black]');
            json_arr.push(pesan.msg);
            json_arr.push(']');
            term.echo(json_arr);
            
            });
            }, {
            
            greetings: null,
            height: 300,
            onInit: function(term) {
                // first question
                var msg = "Selamat datang " + nama;
                typed_message(term, msg, 200, function() {
                    term.set_prompt('> ');
                });
            },
            keydown: function(e) {
                //disable keyboard when animating
                if (anim) {
                    return false;
                }
            }
        });
    });
    $(".terminal").css("--color", "<?= $tema; ?>");
</script>