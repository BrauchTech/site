const express = require('express'),
	app = express(),
	compression = require('compression'),
  	helmet = require('helmet')

app.set('view engine', 'ejs')
app.set('views', './front')

app.use(helmet())
app.use(compression())
app.use('/static', express.static('./front/assets/'))

app.use(function (req, res) {
  res.render('index');
})

app.listen(process.env.PORT || 3000, function () {
	if(!process.env.PORT)
  		console.log('Example app listening on port 3000!');
})

