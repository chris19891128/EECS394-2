package com.google.code.samples.oauth2;

import java.io.File;
import java.io.IOException;
import java.util.Date;

public class Main {
	public static void main(String[] args) throws IOException {
		System.out.println("Finished");
		File tmp = new File(new Date() + ".log");
		tmp.createNewFile();
	}
}
