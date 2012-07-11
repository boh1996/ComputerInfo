/*

	objx core library
	
	Copyright (c) 2009 Mat Ryer
	
	http://objx.googlecode.com/

	Permission is hereby granted, free of charge, to any person obtaining
	a copy of this software and associated documentation files (the
	"Software"), to deal in the Software without restriction, including
	without limitation the rights to use, copy, modify, merge, publish,
	distribute, sublicense, and/or sell copies of the Software, and to
	permit persons to whom the Software is furnished to do so, subject to
	the following conditions:

	The above copyright notice and this permission notice shall be
	included in all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
	EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
	MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
	LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
	OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
	WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
	
*/


// define root namespace
var objx = function(obj){

	// if this is already an objx object -
	//  just return it
	if (objx.isObjx(obj)) {
		return obj;
	}
	
	// create new object
	return new objx.fn.init(obj);
	
};


/*
 *  debug
 *  if 'true' (default), performs additional error checking
 *	to assist development.  This can be set to 'false' for production
 *  and will provide slight performance enhancements.
 */ 
objx.debug = true;


// current version
objx.version = "2.0.11";


// the root object
objx.fn = objx.prototype = {

	// object marker
	_objx: true,


	// actual object
	_obj: null,


	// initialization function
	init: function(obj) {
	
		// save the object
		this.obj(obj);
		
	},
	
	
	/*
	 *  extend
	 *  Extends the selected object 
	 */
	extend: function() {
	
		var args = [];
		
		// add the first argument
		args.push(this._obj);
		
		// add the other arguments
		for (var i = 0; i < arguments.length; i++) {
			args.push(arguments[i]);
		}
	
		// call the extender
		objx.extend.apply(objx, args);
	
		// return this for chaining
		return this;
	
	},
	
	
	/*
	 *  type
	 *  Gets the type of the object
	 */
	type: function() {
		return objx.type(this._obj);
	},
	
	
	/*
	 *  obj()
	 *  Gets or sets the object that is being enhanced
	 *
	 *		objx(obj).obj() == obj
	 *		objx(obj).obj(obj2)
	 *
	 */
	obj: function() {
		if (arguments.length === 0) {
			return this._obj;
		} else {
			this._obj = arguments[0];
		}
		return this;
	},
	
	
	/*
	 *  size()
	 *  Gets the size of the object.
	 */
	size: function() {
	
		if (typeof this._obj.length == "undefined") {
			objx.error("size", "Cannot get the size of " + this.type() + " objects.");
		};
		
		return this._obj.length;
	},
	
	
	/*
	 *  toString()
	 *  Gets a string representing this object - to make debugging easier
	 */
	toString: function() {
		
		var type = this.type();
		var val = this._obj.toString();
		
		switch (type) {
			case "string":
				val = '"' + val + '"';
				break;
			case "function":
				val = " ... "
				break;
			case "array":
			
				var size = this.size();
				
				if (size === 0) {
					val = "0";
				} else {
					val = " 0.." + (this.size() - 1) + " ";
				}
				
				break;
		}
		
		return "(" + type + "(" + val + "))";
	},
	

	/*
	 *  requires
	 *  Instance version of objx.requires
	 *
	 *  Allows objx("Source").requires("item1", "item2").requires("item3");
	 *
	 */
	requires: function() {

		for (var i = 0, l = arguments.length; i<l; i++)
			objx.requires(arguments[0], this.obj());

		return this;

	}
	
};


// setup easy construction
objx.fn.init.prototype = objx.fn;


// keep track of plugins
objx.__plugins = {};


/*
 *  objx.isObjx
 *  checks whether an object is an objx object or not
 *
 *  objx.isObjx( object-to-test )
 *
 */
objx.isObjx = function(o) {
	if (o && o._objx) {
		return true;
	}
	return false;
};


/*
 *  objx.extend
 *  extends the first object with the others
 *
 *  js.extend(destination, source1 [, source2 [, source3]]);
 *  
 *  destination		-	The target object (everything will be copied
 *  										into this object)
 *  sourceX			-	These objects will have their properties, functions
 *  					etc. copied to 'destination'
 *  
 */
objx.extend = function() {
	
	if (objx.debug) {
		if (arguments.length < 2) {
			objx.error("objx.extend", "Must provide at least two arguments when using objx.extend(). See http://code.google.com/p/objx/wiki/extend");
		}
	}
		
	for (var i = 1; i < arguments.length; i++) {
		for (var property in arguments[i]) {
			arguments[0][property] = arguments[i][property];
		}
	}
	
	return arguments[0];
	
};


/*
 *  objx.bind
 *  Binds context and arguments to a function
 *
 *  js.bind(function, context [, argument1 [, argument2]]);
 */
objx.bind = function() {

	var _func = arguments[0] || null;
	var _obj = arguments[1] || this;
	var _args = [];
	
	// add arguments
	for (var i = 2, l = arguments.length; i<l; i++) {
		_args.push(arguments[i]);
	}
	
	// return a new function that wraps everything up
	return function() {
		
		// start an array to get the args
		var theArgs = [];
		
		var i = 0;

		// add every argument from _args
		for (i = 0, l = _args.length; i < l; i++) {
			theArgs.push(_args[i]);
		}
		
		// add any real arguments passed
		for (i = 0, l = arguments.length; i < l; i++) {
			theArgs.push(arguments[i]);
		}

		// call the function with the specified context and arguments
		return _func.apply(_obj, theArgs);

	};
	
};


/*
 *  objx.get
 *
 *  Gets a value from an object by property name
 *
 */
objx.get = function(o, p) {

	if(o !== null && p !== null && o !== undefined && p !== undefined) {
		var dotPos = p.indexOf(".");
		if (typeof o === "object"){
			if (dotPos == -1 && p in o) {
				return o[p];
			}
		} else {
			return null;
		}

		return objx.get(o[p.substring(0, dotPos)], p.substring(dotPos + 1));
	} else {
		return null;
	}
	

};

/**
 * This function sets the value of an object using dot selector
 * @param  {object} source The object to set too
 * @param  {string} path   The string selector path
 * @param  {integer|string} value  The value to set
 * @return {[type]}
 */
objx.set = function(source, path, value) {
    var parts = path.split('.'), len = parts.length, target = source;

    for (var i = 0, part; i < len - 1; i++) {
        part = parts[i];
        target = target[part] == undefined ? (target[part] = {}) : target[part];
    }
    target[parts[len - 1]] = value;
    //return target;
}


/*
 *  objx.requires
 *  Indicates that a plugin is required and throws an error if it is not included
 *
 *  objx.requires( source, plugin )
 *
 *  plugin 	-	The name of the plugin that is required
 *  source 	-	(optional) A name describing the plugin that requires this other plugin
 *
 */
objx.requires = function(plugin, source) {

	// has this been provided?
	if (!objx.__plugins[plugin]) {
		objx.error("requires", "Plugin \"" + plugin + "\" is required by \"" + source + "\" but missing. Are you missing a <script /> tag?  Have you got your <script /> tags in the wrong order?");
	}
	
	return this;
		
};

/*
 *  objx.provides
 *  Indicates that a plugin is being provided
 *
 *	objx.provides( plugin )
 *
 *	plugin - A unique name describing the plugin
 *
 */
objx.provides = function(plugin) {

	// has this already been provided?
	if (objx.__plugins[plugin]) {
		objx.error("provides", "A plugin called \"" + plugin + "\" has already been provided. Have you duplicated a <script /> tag?");
	}
	
	// save the fact that this has been provided
	objx.__plugins[plugin] = true;
	
};

/*
 *  objx.index
 *  Gets the real index from magic index values (i.e can be negative)
 *  
 */
objx.index = function(i, l) {
	return (i > -1) ? i : (l + (i));
};


/*
 *  objx.indexRange
 *  Gets the real index range from magic index values (i.e. can be negative)
 */
objx.indexRange = function(s, e, len) {
	
	var range = {};
	
	// resolve any magic indexes (i.e. negative numbers)
	range.start = objx.index(s, len);
	if (e) {
		range.end = objx.index(e, len);
	} else if (s < 0) {
		range.end = len - 1;
	} else {
		range.end = range.start;
	}
	
	// make sure they're the right way around
	if (s && e) {
	
		s = Math.min(range.start, range.end);
		e = Math.max(range.start, range.end);
	
		range.start = s;
		range.end = e;
	
	}
	
	return range;
	
};


/*
 *  objx.type
 *  Gets the type of object
 */
objx.type = function(o) {
	// return the type of the object
	if (o && typeof o == "object" && typeof o.length != "undefined") {
		return "array";
	} else {
		return typeof o;
	}
};


/*
 *  objx.array
 *  Ensures that an object is an array
 *
 *	(array) objx.array( object );
 *
 */
objx.array = function(o){
	
	if (objx.type(o) != "array") {
		return [o];
	} else {
		return o;
	}
	
};


/*
 *  objx.provided
 *  Gets whether a plugin has been provided or not
 */
objx.provided = function(plugin) {
	return objx.__plugins[plugin] || false;
};


/*
 *  objx.error
 *  Just throws an error
 *
 *  objx.error( message )
 *  objx.error( tag, message )
 */
objx.error = function() {

	// the last thing is the message
	var tag = arguments.length > 1 ? arguments[0] : "Error";
	var message = arguments[arguments.length - 1];
	throw tag + ": " + message;
	
};


/*
 *  objx.toString
 *  Gets a string representation of this object to make debugging easier.
 */
objx.toString = function() {
	return "{objx engine}";
};